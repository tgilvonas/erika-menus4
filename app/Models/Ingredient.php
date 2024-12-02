<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ingredient extends Model
{
    protected $table = 'ingredients';
    protected $guarded = ['id'];

    public function translation($lang = 'lt')
    {
        return $this->hasOne(IngredientTranslation::class, 'ingredient_id')->where('lang', $lang);
    }

    public static function getListWithTranslations($language, $orderByField='', $orderByDirection='', $searchText='', $paginateBy='')
    {
    	$queryObject = self::select(DB::raw('ingredients.id, proteins, carbohydrates, fat, calories, ingredients_translations.translation AS title'))
    		->join('ingredients_translations', 'ingredients.id', '=', 'ingredients_translations.ingredient_id')
    		->where('lang', $language);

    	if (strlen($searchText)>2) {
			$queryObject->where('ingredients_translations.translation', 'like', '%'.$searchText.'%');
		}

		if (!empty($orderByField) && !empty($orderByDirection)) {
			$queryObject->orderBy($orderByField, $orderByDirection);
		} else {
			$queryObject->orderBy('ingredients_translations.translation', 'asc');
		}

		if (is_numeric($paginateBy)) {
            return $queryObject->paginate($paginateBy);
        } else {
		    return $queryObject->get();
        }
    }

    public static function getIngredientWithTranslation($id, $language='lt')
    {
    	return self::select(DB::raw('ingredients.id, proteins, carbohydrates, fat, calories, ingredients_translations.translation AS title'))
    		->join('ingredients_translations', 'ingredients.id', '=', 'ingredients_translations.ingredient_id')
    		->where('lang', $language)
    		->where('ingredients.id', $id)
    		->first();
    }

}
