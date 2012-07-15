<?php
?>
<select name="paralelo" size="1" id="parale_selec" >
    <option>
        <?php foreach ($q as $lista): ?>
            <tr>
                <td><?php echo $lista->getParalelo()?></td>
            </tr>
        <?php endforeach; ?>
    </option>
</select>
    

