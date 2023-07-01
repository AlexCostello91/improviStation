export function computeMealMacroSummary(meal){
    //Should match App\Models\Macro::defaultDisplayUnits()
    let container = {
        calories:{
          "name": "calories",
          "display_unit": null,
          "value": 0
        },
        carbs:{
          "name": "carbs",
          "display_unit": "g",
          "value": 0
        },
        fat:{
          "name": "fat",
          "display_unit": "g",
          "value": 0
        },
        fiber:{
          "name": "fiber",
          "display_unit": "g",
          "value": 0
        },
        protein:{
          "name": "protein",
          "display_unit": "g",
          "value": 0
        },
        sodium:{
          "name": "sodium",
          "display_unit": "mg",
          "value": 0
        },
        sugar:{
          "name": "sugar",
          "display_unit": "g",
          "value": 0
        }
    };

    meal.meal_items.forEach(meal_item => {
        meal_item.macros.forEach(macro=>{
            let val = macro.value;
            if(macro.display_unit == 'mg' && container[macro.name].display_unit=='g'){
                val/=1000;
            } else if(macro.display_unit == 'g' && container[macro.name].display_unit=='mg'){
                val*=1000;
            }
            container[macro.name].value+=val;
        })
    });
    return Object.values(container);
}
