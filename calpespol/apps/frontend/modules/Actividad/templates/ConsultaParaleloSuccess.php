<label class="labelsForm" for="paralelo"> Paralelo: </label>
<select name="paralelo" size="1" id="parale_selec" >
    
        <?php foreach ($q as $para): ?>
        <option>
            <?php echo $para->getParalelo(); ?>
        </option>
        <?php endforeach; ?>
</select>