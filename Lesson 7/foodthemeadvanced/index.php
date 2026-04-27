<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>

      <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        #recipeWrap {
            min-height: 20vh;
            background-color: #f1f4ff;
            border-radius: 0.4rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
        }

        #ingredients {
            min-height: 10vh;
            background-color: white;
            width: 60%;
            color: rgb(39, 21, 21);
            border: 1px black solid;
            border-radius: 0.4rem;
            padding: 2rem;
        }

        .ingredientRow {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem;
        }

        #btnAddIngredient {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background-color: #4f7cff;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        #btnAddIngredient:hover {
            background-color: #3a5dcc;
            transform: scale(1.1);
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }

        .deleteRowButton {
            width: 2rem;
            height: 2rem;
            border-radius: 50%;
            background-color: #ff4f4f;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;

        }

        .deleteRowButton:hover {
            background-color: #cc3a3a;
            transform: scale(1.1);
            box-shadow: 3px 3px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    
    <h1>Recipe maker</h1>

    <div id="recipeWrap">

        <input type="text" id="recipeName" placeholder="name of the recipe">

        <datalist id="foodList"></datalist>

        <div id="ingredients">

        </div>
        <button id="btnAddIngredient">+</button>

        <h2 id="totalCalories">Total calories: </h2>


    </div>


   

    <script>

        class Food {

            constructor(name, weightSuggestion, energyKj, protein, carbs, vegan, vegetarian, glutenFree, lactoseFree, carnivore) {

                this.name = name;
                this.weightSuggestion = weightSuggestion;
                this.energyKj = energyKj;
                this.protein = protein;
                this.carbs = carbs;
                this.vegan = vegan;
                this.vegetarian = vegetarian;
                this.glutenFree = glutenFree;
                this.lactoseFree = lactoseFree;
                this.carnivore = carnivore;

            }

            getCaloriesPer100g() {
                return this.energyKj / 4.184;
            }

            //simple method for calculating calories. We need the grams as an argument, because the calories per gram is a property of the food, but the total calories depends on how much of that food we are using 
            getCalories(grams) {
                return grams * this.getCaloriesPer100g() / 100;
            }
        }

        const foodSearchInput = document.getElementById('foodSearchInput');

        const foodList = document.getElementById('foodList');

        const submitFoodSearch = document.getElementById('submitFoodSearch');



        foodSearchInput.addEventListener('input', () => {
            const searchTerm = foodSearchInput.value.toLowerCase().trim();

            foodList.innerHTML = '';

            foods.forEach(food => {

                const option = document.createElement('option');

                option.value = food.name;

                foodList.appendChild(option);
            })


        })


        submitFoodSearch.addEventListener('click', () =>{
            const value = foodSearchInput.value.toLowerCase().trim();
            fetchFoodData(value);
        })

        function fetchFoodData(foodName){
            //we will continue here next time
        }
            
        

    </script>

</body>

</html>