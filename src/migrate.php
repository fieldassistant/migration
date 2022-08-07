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
<pre id="log"></pre>
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
        log.innerText += error.message + "\n";
        console.log(error);
    }

    // Only do things if we have new data.
    if (data.timestamp) {
        log.innerText += "Received migration data\n";

        let ok = true;

        // We're going to overwrite something.
        if (entries.timestamp) {
            log.innerText += "Found existing data\n";

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
            log.innerText += "Writing data\n";
            localStorage.setItem('persist:entries', JSON.stringify(data));
        }
        else {
            log.innerText += "Skip migration\n";
        }
    }

    location.replace('/');
}();
</script>
</body>
</html>
