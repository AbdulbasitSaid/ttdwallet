<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

/**
 * Class Expense
 *
 * @package App
 * @property string $expense_category
 * @property string $entry_date
 * @property string $amount
 * @property string $branch
*/
class Expense extends Model
{
    protected $fillable = ['entry_date', 'amount', 'expense_category_id', 'branch_id'];
    protected $hidden = [];
    
    
    public static function boot()
    {
        parent::boot();

        Expense::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setExpenseCategoryIdAttribute($input)
    {
        $this->attributes['expense_category_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setEntryDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['entry_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['entry_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getEntryDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setBranchIdAttribute($input)
    {
        $this->attributes['branch_id'] = $input ? $input : null;
    }
    
    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }
    
    public function branch()
    {
        return $this->belongsTo(User::class, 'branch_id');
    }
    
}
