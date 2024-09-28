<?php
// index.php
// นำเข้าไฟล์ config.php เพื่อใช้ค่าคอนฟิก
require_once 'Member.php'; // นำเข้าไฟล์ Database.php เพื่อใช้คลาส Database

$member = new Members();
$Showmember = $member->getAllMembers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
</head>

<button onclick="addMember()">เพิ่มสมาชิก</button>
<div>
    <table border="1">
        <tr style="padding: 5px;">
            <th>MemberID</th>
            <th>Member Name</th>
            <th>Member Email</th>
            <th>Purchased</th>
            <th>Point</th>
            <th>debt</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php
        try {
        ?>
            <?php while ($row = $Showmember->fetch(PDO::FETCH_ASSOC)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['memberID']); ?></td>
                    <td><?php echo htmlspecialchars($row['memberName']); ?></td>
                    <td><?php echo htmlspecialchars($row['memberEmail']); ?></td>
                    <td><?php echo htmlspecialchars($row['purchased']); ?></td>
                    <td><?php echo htmlspecialchars($row['point']); ?></td>
                    <td><?php echo htmlspecialchars($row['debt']); ?></td>
                    <td><a href="EditMember.php?id=<?php echo $row['memberID']; ?>">Update</a></td>
                    <td><a href="deleteMember.php?id=<?php echo $row['memberID']; ?>">Delete</a></td>
                </tr>
                </tr>
        <?php
            } // 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        ?>
</div>
</body>
<script>
    function addMember() {
        location.replace("Addmember.php");
    }
</script>

</html>