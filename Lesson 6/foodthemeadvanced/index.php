<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>

<body>

    <input type="text" id="foodSearchInput">
    <datalist id="foodList"></datalist>

    <script>

        const foodSearchInput = document.getElementById('foodSearchInput');

        const foodList = document.getElementById('foodList');

        foodSearchInput.addEventListener('input', () => {
            const searchTerm = foodSearchInput.value.toLowerCase().trim();

            foodList.innerHTML = '';

            foods.forEach(food => {

                const option = document.createElement('option');

                option.value = food.name;

                foodList.appendChild(option);
            })


        })

    </script>

</body>

</html>