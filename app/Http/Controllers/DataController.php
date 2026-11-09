<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;

class DataController extends Controller
{
    protected $tables = [
        'user',
        'access',
        'achievement',
        'achievement_detail',
        'app_config',
        'app_menu',
        'app_slider',
        'collaboration_logo',
        'consultation_set',
        'cons_schedule',
        'custom_page',
        'facility',
        'facility_detail',
        'gallery',
        'gallery_school',
        'gallery_tag',
        'gallery_tag_detail',
        'history',
        'history_detail',
        'history_video',
        'job',
        'job_detail',
        'job_school',
        'job_source',
        'page',
        'popup',
        'post',
        'post_school',
        'post_tag',
        'post_tag_detail',
        'program',
        'program_detail',
        'scholarship',
        'school',
        'schs_file',
        'service_hour',
        'student_reg',
        'testimony',
        'testimony_detail',
    ];

    protected function getPrimaryKey($tableName, $columns)
    {
        if (in_array('id', $columns)) {
            return 'id';
        }
        if (in_array("{$tableName}_id", $columns)) {
            return "{$tableName}_id";
        }
        return $columns[0] ?? 'id';
    }

    protected function getExcludedColumns($tableName, $columns)
    {
        $primaryKey = $this->getPrimaryKey($tableName, $columns);

        return [
            $primaryKey,
            'created_at',
            'updated_at',
            'deleted_at',
            'datetime_created',
            'datetime_last_updated',
            'datetime_last_login',
        ];
    }

    protected function isFileColumn($columnName)
    {
        $colLower = strtolower($columnName);
        return (bool) preg_match('/(file|image|img|photo|foto|logo|icon|upload|avatar|header|bg|background|banner|doc|pdf|attachment|program_detail_content)/i', $colLower);
    }

    protected function validateTable($tableName)
    {
        if (!in_array($tableName, $this->tables) || !Schema::hasTable($tableName)) {
            abort(404, "Tabel '{$tableName}' tidak ditemukan atau tidak diizinkan.");
        }
    }

    // METHOD INDEX
    public function index(Request $request, $tableName = null)
    {
        $tableName = $tableName ?? $request->query('table', 'user');
        $this->validateTable($tableName);

        $tables = $this->tables;
        $columns = Schema::getColumnListing($tableName);
        $primaryKey = $this->getPrimaryKey($tableName, $columns);
        $excluded = $this->getExcludedColumns($tableName, $columns);

        $search = $request->query('search');
        $query = DB::table($tableName);

        if (!empty($search)) {
            $query->where(function ($q) use ($columns, $search) {
                foreach ($columns as $index => $column) {
                    if ($index === 0) {
                        $q->where($column, 'LIKE', "%{$search}%");
                    } else {
                        $q->orWhere($column, 'LIKE', "%{$search}%");
                    }
                }
            });
        }

        $rows = $query->orderBy($primaryKey, 'desc')
            ->paginate(15)
            ->withQueryString();

        $formColumns = array_values(array_diff($columns, $excluded));

        return view('data.index', compact('tables', 'tableName', 'columns', 'rows', 'formColumns', 'primaryKey', 'search'));
    }

    public function create(Request $request, $tableName)
    {
        $this->validateTable($tableName);

        $tables = $this->tables;
        $columns = Schema::getColumnListing($tableName);
        $primaryKey = $this->getPrimaryKey($tableName, $columns);
        $excluded = $this->getExcludedColumns($tableName, $columns);
        $formColumns = array_values(array_diff($columns, $excluded));

        return view('data.form', [
            'tables' => $tables,
            'tableName' => $tableName,
            'formColumns' => $formColumns,
            'primaryKey' => $primaryKey,
            'row' => null,
            'isEdit' => false
        ]);
    }

    public function edit(Request $request, $tableName, $id)
    {
        $this->validateTable($tableName);

        $tables = $this->tables;
        $columns = Schema::getColumnListing($tableName);
        $primaryKey = $this->getPrimaryKey($tableName, $columns);
        $excluded = $this->getExcludedColumns($tableName, $columns);
        $formColumns = array_values(array_diff($columns, $excluded));

        $row = DB::table($tableName)->where($primaryKey, $id)->first();
        if (!$row) {
            abort(404, "Data tidak ditemukan pada tabel '{$tableName}'.");
        }

        return view('data.form', [
            'tables' => $tables,
            'tableName' => $tableName,
            'formColumns' => $formColumns,
            'primaryKey' => $primaryKey,
            'row' => $row,
            'isEdit' => true
        ]);
    }

    public function store(Request $request, $tableName)
    {
        $this->validateTable($tableName);

        $columns = Schema::getColumnListing($tableName);
        $excluded = $this->getExcludedColumns($tableName, $columns);
        $formColumns = array_values(array_diff($columns, $excluded));

        $data = $request->only($formColumns);

        foreach ($formColumns as $column) {
            if ($request->hasFile($column)) {
                $file = $request->file($column);
                $data[$column] = $file->store('uploads/' . $tableName, 'public');
            } elseif ($request->hasFile($column . '_file')) {
                $file = $request->file($column . '_file');
                $data[$column] = $file->store('uploads/' . $tableName, 'public');
            } elseif ($this->isFileColumn($column) && empty($data[$column])) {
                unset($data[$column]);
            }
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $now = now();
        if (in_array('created_at', $columns)) $data['created_at'] = $now;
        if (in_array('datetime_created', $columns)) $data['datetime_created'] = $now;
        if (in_array('updated_at', $columns)) $data['updated_at'] = $now;
        if (in_array('datetime_last_updated', $columns)) $data['datetime_last_updated'] = $now;

        try {
            DB::table($tableName)->insert($data);
        } catch (UniqueConstraintViolationException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan: Data ganda terdeteksi!');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan query database: ' . $e->getMessage());
        }

        return redirect()->route('data.index', ['tableName' => $tableName])
            ->with('success', "Data berhasil ditambahkan ke tabel '{$tableName}'!");
    }

    public function update(Request $request, $tableName, $id)
    {
        $this->validateTable($tableName);

        $columns = Schema::getColumnListing($tableName);
        $primaryKey = $this->getPrimaryKey($tableName, $columns);
        $excluded = $this->getExcludedColumns($tableName, $columns);
        $formColumns = array_values(array_diff($columns, $excluded));

        $existingRow = DB::table($tableName)->where($primaryKey, $id)->first();
        if (!$existingRow) {
            abort(404, "Data tidak ditemukan pada tabel '{$tableName}'.");
        }

        $data = $request->only($formColumns);

        foreach ($formColumns as $column) {
            if ($request->hasFile($column)) {
                if (!empty($existingRow->{$column}) && Storage::disk('public')->exists($existingRow->{$column})) {
                    Storage::disk('public')->delete($existingRow->{$column});
                }
                $file = $request->file($column);
                $data[$column] = $file->store('uploads/' . $tableName, 'public');
            } elseif ($request->hasFile($column . '_file')) {
                if (!empty($existingRow->{$column}) && Storage::disk('public')->exists($existingRow->{$column})) {
                    Storage::disk('public')->delete($existingRow->{$column});
                }
                $file = $request->file($column . '_file');
                $data[$column] = $file->store('uploads/' . $tableName, 'public');
            } else {
                if ($this->isFileColumn($column) && empty($data[$column])) {
                    unset($data[$column]);
                }
            }
        }

        if (array_key_exists('password', $data)) {
            if (empty($data['password'])) {
                unset($data['password']);
            } else {
                $data['password'] = Hash::make($data['password']);
            }
        }

        $now = now();
        if (in_array('updated_at', $columns)) $data['updated_at'] = $now;
        if (in_array('datetime_last_updated', $columns)) $data['datetime_last_updated'] = $now;

        try {
            DB::table($tableName)->where($primaryKey, $id)->update($data);
        } catch (UniqueConstraintViolationException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui: Data ganda terdeteksi!');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan query database: ' . $e->getMessage());
        }

        return redirect()->route('data.index', ['tableName' => $tableName])
            ->with('success', "Data pada tabel '{$tableName}' berhasil diperbarui!");
    }

    public function destroy($tableName, $id)
    {
        $this->validateTable($tableName);

        $columns = Schema::getColumnListing($tableName);
        $primaryKey = $this->getPrimaryKey($tableName, $columns);

        $row = DB::table($tableName)->where($primaryKey, $id)->first();
        if ($row) {
            foreach ($columns as $column) {
                if ($this->isFileColumn($column) && !empty($row->{$column})) {
                    if (Storage::disk('public')->exists($row->{$column})) {
                        Storage::disk('public')->delete($row->{$column});
                    }
                }
            }
            DB::table($tableName)->where($primaryKey, $id)->delete();
        }

        return redirect()->route('data.index', ['tableName' => $tableName])
            ->with('success', "Data berhasil dihapus dari tabel '{$tableName}'!");
    }
}
