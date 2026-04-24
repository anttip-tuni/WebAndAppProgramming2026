<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>

<body>

    <input type="text" id="foodSearchInput" list="foodList">
    <datalist id="foodList"></datalist>

    <button id="submitFoodSearch">Search</button>

    <script>

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