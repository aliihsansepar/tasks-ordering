<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Task extends Model
    {
        use HasFactory, SoftDeletes;

        public $timestamps = true;
        protected $fillable = ['title', 'type', 'prerequisites', 'country'];
        protected $table = 'tasks';
        protected $casts = [
            'prerequisites' => 'array'
        ];

        public function amount()
        {
            return $this->hasOne(Amount::class, 'task_id', 'id');
        }

        public function getPrerequisitesAttribute($value)
        {
            if (is_null($value)) {
                return [];
            }
            return json_decode($value, 1);
        }

        public function getPrerequisitesOptionAttribute($value)
        {
            $options = [];
            if (is_null($this->prerequisites)) {
                return [];
            }

            foreach ($this->prerequisites as $val) {
                $options[$val] = 'Task ' . $val;
            }
            return $options;
        }

        public function getTypeAttribute($value)
        {
            return str_replace('_ops', '', $value);
        }
    }
