<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php
echo 'User IP Address : '. $_SERVER['REMOTE_ADDR'];
?>
<br>

<?php
 $MAC=exec('getmac'); 
 $MAC=strtok($MAC, ' '); 
 echo "MAC address of client is: $MAC"; 
?>

    <p>
        <button onclick="readTag()">Test NFC Read</button>
        <button onclick="writeTag()">Test NFC Write</button>
    </p>
  <pre id="log"></pre>
  <!-- <p><small>Based on the code snippets from <a href="https://w3c.github.io/web-nfc/#examples">specification draft</a>.</small></p> -->

  <script>
   async function readTag() {
    if ("NDEFReader" in window) {
        const ndef = new NDEFReader();
        try {
        await ndef.scan();
        ndef.onreading = event => {
            const decoder = new TextDecoder();
            for (const record of event.message.records) {
            consoleLog("Record type:  " + record.recordType);
            consoleLog("MIME type:    " + record.mediaType);
            consoleLog("=== data ===\n" + decoder.decode(record.data));
            }
        }
        } catch(error) {
        consoleLog(error);
        }
    } else {
        consoleLog("Web NFC is not supported.");
    }
    }

async function writeTag() {
  if ("NDEFReader" in window) {
    const ndef = new NDEFReader();
    try {
      await ndef.write("What Web Can Do Today");
      consolelog("NDEF message written!");
    } catch(error) {
      consolelog(error);
    }
  } else {
    consolelog("Web NFC is not supported.");
  }
}

function consolelog(data) {
  var logElement = document.getElementById('log');
  logElement.innerHTML += data + '\n';
  alert(data);
};

  </script>