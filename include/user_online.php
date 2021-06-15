<script>
    <?php if (isset($_SESSION['user_role'])) { ?>

        function loadUsersOnline() {
            $.get("include/function.php?onlineusers=result", function(data) {
                $(".useronline").text(data);
            });
        }
        setInterval(function() {
            loadUsersOnline();
        }, 500);
    <?php } else { ?>
        $(".useronline").text("0");
    <?php } ?>
</script>