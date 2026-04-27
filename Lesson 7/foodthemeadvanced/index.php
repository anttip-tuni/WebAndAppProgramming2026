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
        <h2 id="totalCarbs">Total carbs: </h2>


    </div>


   

    <script>

        class Food {

            constructor(id, name, weightSuggestion, energyKj, protein, carbs, vegan, vegetarian, glutenFree, lactoseFree, carnivore) {

                this.id = id;
                this.name = name;
                this.weightSuggestion = weightSuggestion;
                this.energyKj = energyKj;
                this.protein = protein;
                this.carbs = carbs;
                this.vegan = vegan; //if no value is provided for these boolean properties, they will be undefined, which is a falsy value in JavaScript. So if we check for example if (food.vegan) and the vegan property is not provided, it will evaluate to false and we can treat it as not vegan. This way we can have a simple way of handling missing data without having to explicitly set the value of these properties for every food item in our database.
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
            
            getCarbs(grams) {
                return grams * this.carbs / 100;
            }

        } /* end class Food */

        const foods = foodsFromDatabase.map(food => {
            return new Food (
                food.id,
                food.name,
                100, //default weight suggestion is 100 grams, but this could be something we store in the database as well and retrieve along with the other properties of the food
                food.energyKj,
                food.protein,
                food.carbs,
                false, //vegan
                false, //vegetarian
                false, //glutenFree
                false, //lactoseFree
                false  //carnivore
            )
        })


        const ingredients = document.getElementById('ingredients');

        const foodList = document.getElementById('foodList');

        const btnAddIngredient = document.getElementById('btnAddIngredient');

        const totalCalories = document.getElementById('totalCalories');
        const totalCarbs = document.getElementById('totalCarbs');

        //rebuild the datalist while the usser types in the search input
        function updateFoodList(searchTerm){
            const cleanedSearchTerm = searchTerm.trim().toLowerCase(); //remove whitespace and convert to lowercase for easier searching. trim() only removes whiotespace from the beginning and end of the string, not from the middle, so if the user types "  apple  " it will be converted to "apple", but if they type "green apple" it will stay as "green apple"

            const startsWithMatches = foods.filter(food => food.name.toLowerCase().startsWith(cleanedSearchTerm)); //get the foods that start with the search term

            console.log('startsWithMatches: ', startsWithMatches);

            startsWithMatches.sort((foodA, foodB) => {
                return foodA.name.length - foodB.name.length; //sort the matches so that the shortest names come first, because they are usually easier to read and more likely to be what the user is looking for. For example if the user types "apple", we want "Apple" to come before "Green apple" in the list of matches, because "Apple" is a more likely match for the user's intent when they type "apple" 
            })

        //Now take ONLY the foods that DONT start with the search term, but INCLUDE the foods that start with the search term, because we want to show them in the datalist as well
        
        const includesMatchesButDoesntStartWithOne = foods.filter(food => {
            const foodname = food.name.toLowerCase(); 
            return !foodname.startsWith(cleanedSearchTerm) && foodname.includes(cleanedSearchTerm);

        }
         
        
        ); //get the foods that start with the search term

            console.log('startsWithMatches: ', startsWithMatches);

            includesMatchesButDoesntStartWithOne.sort((foodA, foodB) => {
                return foodA.name.length - foodB.name.length; //sort the matches so that the shortest names come first, because they are usually easier to read and more likely to be what the user is looking for. For example if the user types "apple", we want "Apple" to come before "Green apple" in the list of matches, because "Apple" is a more likely match for the user's intent when they type "apple" 
            })

            //merge the two array together with startsWithMatches first, because we want the foods that start with the search term to come first in the datalist, and then the foods that include the search term but dont start with it, so that they are still visible to the user but not as prominent as the ones that start with the search term
            const orderedFoods = startsWithMatches.concat(includesMatchesButDoesntStartWithOne);




            foodList.innerHTML = ''; //clear the datalist before adding the new options
            orderedFoods.forEach(food => {
                const option = document.createElement('option');
                option.value = food.name; 
                foodList.appendChild(option);
            })
                
        }

function createIngredientRow() {

            const row = document.createElement('div');
            row.className = 'ingredientRow';



            const foodInput = document.createElement('input');
            foodInput.className = 'foodInput';
            foodInput.type = 'text';
            foodInput.placeholder = 'Ingredient name';
            foodInput.setAttribute('list', 'foodList'); //this makes the input show the datalist as a dropdown when the user clicks on it or starts typing

            foodInput.addEventListener('input', () => {
                updateFoodList(foodInput.value); //update the datalist options based on the user's input
            });

            const gramsInput = document.createElement('input');
            gramsInput.className = 'gramsInput';
            gramsInput.type = 'number';
            gramsInput.placeholder = 'enter ingredient grams';
            gramsInput.min = 0;
            gramsInput.value = foods[0].weightSuggestion;

            const caloriesDisplay = document.createElement('div');
            caloriesDisplay.className = 'caloriesDisplay';
            caloriesDisplay.textContent = foods[0].getCalories(foods[0].weightSuggestion) + ' calories';

            //delete button
            const deleteButton = document.createElement('button');
            deleteButton.className = 'deleteRowButton';
            deleteButton.textContent = 'X';

            row.appendChild(foodInput);
            row.appendChild(gramsInput);
            row.appendChild(caloriesDisplay);
            row.appendChild(deleteButton);

            deleteButton.addEventListener('click', () => {
                row.remove();
                calculateTotals();
            });

     

            gramsInput.addEventListener('input', updateRow); //when the user types in the grams input, we want to update the calories display

            function updateRow() {
                const selectedFood = findFoodByName(foodInput.value); //get the Food from the foods array that matches with the selected element in the dropdown

                const grams = gramsInput.value || 0; //get the value from the grams input OR if it's empty, use 0
                const calories = selectedFood.getCalories(grams); //calculate the calories using the getCalories method of the Food class
                caloriesDisplay.textContent = Math.round(calories) + ' calories'; //update the calories display with the new calories

                calculateTotals();
            }

            function addWeightSuggestion() {
                const selectedFood = findFoodByName(foodInput.value); //get the Food from the foods array that matches with the selected element in the dropdown
                gramsInput.value = selectedFood.weightSuggestion; //update the grams input with the weight suggestion of the selected food
                updateRow(); //also update the calories display, because we changed the grams input
            }

            foods.forEach(food => { //loop trough the foods array 
                const option = document.createElement("option"); //options are items in a drop down menu
                option.value = food.name; //setting the hidden value of each option
                option.textContent = food.name; //setting the visible value of each option
                
            })

            ingredients.appendChild(row);

            calculateTotals();

        }


        //because we have an id called addIngredient, we can actually just refer to it like a variable, because the browser creates a global variable for each element with an id, so we can just do addIngredient instead of document.getElementById('addIngredient')
        //warning: this is not a good practice, because it can lead to bugs and confusion, because you might have a variable with the same name as an id, and then you won't know which one is which, so it's better to always use document.getElementById('id') to avoid confusion 
        btnAddIngredient.addEventListener('click', createIngredientRow);


        function calculateTotals() {

            let totalCaloriesValue = 0;
            let totalCarbsValue = 0;

            const ingredientRows = document.querySelectorAll('.ingredientRow'); //get all the ingredient rows

            console.log('ingredientRows: ', ingredientRows);

            ingredientRows.forEach(row => {

                const foodInput = row.querySelector('.foodInput'); //get the food input from the row

                //lets traverse a bit
     
                const gramsInput = row.querySelector('.gramsInput'); //get the grams input from the row

                const selectedFood = findFoodByName(foodInput.value); //get the Food from the foods array that matches with the selected element in the dropdown

                const grams = gramsInput.value || 0; //get the value from the grams input OR if it's empty, use 0

                if (selectedFood === undefined){
                    return; //if the selected food is not found in the foods array, we just skip this row and move on to the next one, because we can't calculate the calories for this row if we don't have a valid food selected
                }

                totalCaloriesValue += selectedFood.getCalories(grams); //calculate the calories using the getCalories method of the Food class and add it to the total
                totalCarbsValue += selectedFood.getCarbs(grams); //calculate the carbs using the getCarbs method of the Food class and add it to the total   

            }); /* Ends the forEach loop */

            totalCalories.textContent = 'Total calories: ' + Math.round(totalCaloriesValue); //update the total calories display with the new total
            totalCarbs.textContent = 'Total carbs: ' + Math.round(totalCarbsValue); //update the total carbs display with the new total  

        }

        function findFoodByName(searchname) {
            return foods.find(food => {
                return food.name.toLowerCase() === searchname.trim().toLowerCase(); //we compare the lowercase version of the food name with the lowercase version of the input name, and we also trim the input name to remove any extra whitespace, so that if the user types "  apple  " it will still match with "Apple" in the foods array
            });
        
        };


        createIngredientRow();

        calculateTotals();
            
        

    </script>

</body>

</html>