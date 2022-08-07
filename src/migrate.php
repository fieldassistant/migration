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
<script id="migrate" type="application/json"><?php echo $_POST['data'] ?? '{"timestamp":0}' ?></script>
<script>
!function() {
    const data = JSON.parse(migrate.innerHTML);
    let entries = {timestamp: 0};

    try {
        const store = localStorage.getItem('persist:entries');
        entries = JSON.parse(store);
    }
    catch (error) {
        console.log(error);
    }

    // Only do things if we have new data.
    if (data.timestamp) {
        let ok = true;

        // We're going to overwrite something.
        if (entries.timestamp) {

            // But only ask if we've got newer data.
            if (data.timestamp > entries.timestamp) {
                ok = confirm('Entries exist, override?');

                if (ok) {
                    ok = confirm('Are you sure?');
                }
            }
            // Otherwise we're not overwriting. Existing data is already newer
            // so assume the migration already worked.
            else {
                ok = false;
            }
        }
        // There's no existing data, write in our new stuff.
        else {
            ok = true;
        }

        if (ok) {
            localStorage.setItem('persist:entries', JSON.stringify(data));
        }
    }

    location.replace('/');
}();
</script>
</body>
</html>
