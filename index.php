<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Image Redirect Link Creator</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      color: #fff;
    }
    .container {
      background: rgba(0,0,0,0.6);
      padding: 30px;
      border-radius: 15px;
      width: 400px;
      text-align: center;
      box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }
    h2 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #ffdd57;
    }
    label {
      display: block;
      margin-top: 15px;
      text-align: left;
      font-weight: bold;
    }
    input {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 8px;
      border: none;
      outline: none;
    }
    button {
      margin-top: 20px;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 8px;
      background: #ff4757;
      color: white;
      font-size: 16px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #e84118;
    }
    .result-box {
      margin-top: 25px;
      padding: 15px;
      background: #2f3542;
      border-radius: 10px;
      display: none;
    }
    .result-box p {
      margin: 0;
      font-size: 14px;
      color: #fff;
    }
    .short-link {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background: #57606f;
      margin-top: 10px;
      padding: 8px;
      border-radius: 6px;
    }
    .short-link input {
      border: none;
      background: transparent;
      color: #fff;
      width: 80%;
      font-size: 14px;
    }
    .copy-btn {
      background: #1e90ff;
      border: none;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 12px;
    }
    .copy-btn:hover {
      background: #3742fa;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>🔗 Create Redirect Link</h2>
    <form id="linkForm" action="create.php" method="POST" enctype="multipart/form-data">
      <label>Upload Image:</label>
      <input type="file" name="image" accept="image/*" required>

      <label>Destination Website:</label>
      <input type="url" name="url" placeholder="https://example.com" required>

      <label>Redirect Timer (seconds):</label>
      <input type="number" name="timer" value="5" min="0">

      <button type="submit">Create Link</button>
    </form>

    <div class="result-box" id="resultBox">
      <p>✅ Your Short Link:</p>
      <div class="short-link">
        <input type="text" id="shortLink" readonly>
        <button class="copy-btn" onclick="copyLink()">Copy</button>
      </div>
    </div>
  </div>

  <script>
    // AJAX form submit
    document.getElementById("linkForm").onsubmit = async function(e) {
      e.preventDefault();
      let formData = new FormData(this);
      let response = await fetch("create.php", { method: "POST", body: formData });
      let link = await response.text();

      // Show result box
      document.getElementById("resultBox").style.display = "block";
      document.getElementById("shortLink").value = link.trim();
    };

    // Copy button
    function copyLink() {
      let copyText = document.getElementById("shortLink");
      copyText.select();
      copyText.setSelectionRange(0, 99999); 
      document.execCommand("copy");
      alert("Copied: " + copyText.value);
    }
  </script>
</body>
</html>
