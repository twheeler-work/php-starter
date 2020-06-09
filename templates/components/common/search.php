<div class="search-container">
    <form>
        <div class="form-group search-filter">
            <select id="searchFilter" class="form-control btn">
                <option selected>Search Options</option>
                <?php foreach ($links['searchDropdown'] as $key => $i) : ?>
                    <option value="<?php echo $key ?>"><?php echo $i ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group search-field">
            <!-- Search field -->
            <input type="text" class="form-control" name="search" id="searchField" aria-describedby="search" placeholder="Search...">
        </div>
        <button type="submit" id='searchBtn' class="btn btn-primary search-btn">Search</button>
    </form>
</div>