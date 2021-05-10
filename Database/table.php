<?php
    
    require "connect.php";

    $tabledata = $con->find();
        foreach($tabledata as $oneData)
        { 
            $id = $oneData['_id'];
            ?>
            <tr class="align-items-center">
                <td><img style="width: 60px; height: 60px; border-radius: 15px;" src="<?php echo $oneData['userimage']; ?>"/></td>
                <td><?php echo $oneData['name']; ?></td>
                <td><?php echo $oneData['email']; ?></td>
                <td><?php echo $oneData['dob']; ?></td>
                <td><?php echo $oneData['gender']; ?></td>
                <td><button type="button" name="btn_update" class="btn btn-success" onclick="location.href='index.php?id=<?php echo $id;?>';">Update</button></td>
                <td><button type="button" name="btn_delete" class="btn btn-danger" onclick="location.href='delete.php?id=<?php echo $id;?>';">Delete</button></td>
            </tr>
    <?php }
?>