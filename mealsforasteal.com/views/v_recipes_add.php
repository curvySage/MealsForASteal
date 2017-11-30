<body>
<div id="content-section">
    <!-- Stuff goes here -->
    <div class="add-recipe">
        <form action="/recipes/p_add" method="post" id="add-recipe" class="add-recipe-form" enctype="multipart/form-data">
            <div class="add-recipe-title">
                <span class="title-label">Title:</span>
                <input name="title" type="text" value="" placeholder="Title" class="recipe-title" id="title" />
            </div>


            <div class="add-recipe-photo">
                Upload Photo:
                <input type="file" id="upload" name="upload"/>
            </div>


            <div class="add-recipe-ingredients">
                <span class="ingredients-title">Ingredients (seperate using commas):</span>
                <!-- Dynamically add/remove text fields for ingredients -->
                <div class="add-ingredient-input" id=ingredient-form>
                    <input name="ingredients" type="text" value="" placeholder="Ingredients (seperate using commas)" class="ingredient" id="first-ingredient" title="amount and ingredient" />
                </div>
            </div>
            <div class="add-recipe-instructions">
                <span class="instructions-title">Instructions:</span>
                <textarea name="description" class="instructions" placeholder="Add instructions" title="add instructions"></textarea>
            </div>
            <!-- Submit form-->

            <div class="final-buttons">
                <input type="submit" value="Add" class="add-button" />
                <input type="reset" value="Clear" class="clear-button" onclick="clearAll();" />
            </div>
        </form>
    </div>
</div>
</body>