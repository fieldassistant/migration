<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Assistant Migration</title>
</head>
<body>
<h1>Please wait... (2/2)</h1>
<script id="migrate" type="application/json"><?php echo $_POST['data'] ?? 'null' ?></script>
<script>
!function() {
    const data = migrate.innerHTML;
    const entries = localStorage.getItem('persist:entries');

    if (data && entries) {
        let ok = confirm('Entries exist, override?');

        if (ok) {
            ok = confirm('Are you sure?');
        }

        if (ok) {
            localStorage.setItem('persist:entries', data);
        }
    }

    location.replace('/');
}();
</script>
</body>
</html>
