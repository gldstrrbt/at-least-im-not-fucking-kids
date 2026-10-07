<?php
$sins = file_exists(__DIR__ . "/sins.txt") ? file(__DIR__ . "/sins.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AtLeastImNotFuckingKids.com</title>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-BHC5HNJ6GQ"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'G-BHC5HNJ6GQ');
</script>

  <link rel="icon" href="favicons/favicon.ico" sizes="any">
  <link rel="icon" href="favicons/favicon-32x32.png" type="image/png" sizes="32x32">
  <link rel="icon" href="favicons/favicon-16x16.png" type="image/png" sizes="16x16">
  <link rel="apple-touch-icon" href="favicons/apple-touch-icon.png">
  <link rel="icon" href="favicons/android-chrome-192x192.png" type="image/png" sizes="192x192">
  <link rel="icon" href="favicons/android-chrome-512x512.png" type="image/png" sizes="512x512">
  <link rel="manifest" href="favicons/site.webmanifest">
  <meta name="theme-color" content="#111"> <style>
     body {
       margin: 0;
       padding: 0;
       font-family: 'IBM Plex Mono', monospace;
       background-color: #111;
       color: #eee;
       display: flex;
       flex-direction: column;
       align-items: center;
       justify-content: center;
       min-height: 100vh;
       text-align: center;
       background-image: radial-gradient(circle at center, #222 0%, #111 100%);
     }

     h1 {
       font-size: 1.5rem;
       margin: 1rem 1rem 0 1rem;
     }

     p.subtitle {
       font-size: 1.1rem;
       color: #aaa;
       /*margin-bottom: 2rem;*/
       margin-bottom:1.7rem;
     }

     #output {
       font-size: 1.5rem;
       background-color: #1a1a1a;
       padding: 1.5rem;
       border-radius: 12px;
       max-width: 90vw;
       /*margin-bottom: 1.5rem;*/
       margin-bottom:1.1rem;
       border: 1px solid #333;
     }

     #confirmation {
       font-size: 1rem;
       color: #6f6;
       margin-top: 1rem;
       display: none;
     }

     button, input[type="submit"] {
       padding: 0.75rem 1.5rem;
       font-size: 1rem;
       border: none;
       border-radius: 8px;
       background-color: #ff3c3c;
       color: white;
       cursor: pointer;
       transition: background-color 0.2s ease;
       margin-top: 0.5rem;
     }

     button:hover, input[type="submit"]:hover {
       background-color: #e32f2f;
     }

         
          .social-icons {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            font-size: 2rem;
          }

          .social-icons a {
            color: #eee;
            transition: color 0.2s ease;
          }

          .social-icons a:hover {
            color: #ff3c3c;
            text-decoration: none;
          }
         
         
    .product-promo-image {
        /*max-width: 90%; */
        max-width: 1020px;
        width:90vw;
        height: auto;
        /*margin-top: 2rem; */
        margin-top:2rem;
        margin-bottom: 2rem;
        border-radius: 12px;
        /*border: 1px solid #333; */
        border:5px solid #e1e1e1 !important;
        border-color:#e1e1e1 !important;
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
     
      .product-promo-link {
        text-decoration: none;
      }
      .product-promo-link:hover {
        text-decoration: none;
      }


     footer {
       margin-top: 3rem;
       font-size: 0.85rem;
       color: #666;
       padding: 1rem;
     }

     a {
       color: #ff3c3c;
       text-decoration: none;
     }

     a:hover {
       text-decoration: underline;
     }

     form {
       margin-top: 2rem;
       display: flex;
       flex-direction: column;
       align-items: center;
     }

     input[type="text"] {
       width: 80vw;
       max-width: 500px;
       padding: 0.5rem;
       font-size: 1rem;
       margin-bottom: 0.5rem;
       border-radius: 6px;
       border: 1px solid #444;
       background-color: #1a1a1a;
       color: #eee;
     }

     #doomer-wojak {
       display: block;
       position: relative;
       margin: 0 auto;
       max-width: 200px;
     }
     @keyframes pulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.03); }
      100% { transform: scale(1); }
     }
     
     button#generateBtn {
      animation: pulse 2s infinite ease-in-out;
     }
  </style>
</head>
<body>
  <h1>AtLeastImNotFuckingKids.com</h1>
  <p class="subtitle" id="subtitleText"></p>

  <div id="output"></div>
  <img id="doomer-wojak" alt="Doomer Wojak" src="assets/doomer-wojak.png">
    <button id="generateBtn" onclick="trackButtonClick('Generate Sin Button'); generate();">Click for Another Confession</button>

<div style="margin-top: 0.5rem;">
    <a href="https://atleastidont.myshopify.com" target="_blank" rel="noopener"
   style="font-size: 0.95rem; color: #aaa; text-decoration: underline;"
        onclick="trackLinkClick('Shop Link - Text', 'https://atleastidont.myshopify.com');">
  Get the shirt →
 </a>
</div>


  <form onsubmit="trackFormSubmit('Submit Sin Button'); submitSin(event);">
     <input type="text" id="newSin" placeholder="Your confession here..." maxlength="150">
     <input type="submit" value="Submit Your Sin">
     <div id="confirmation">Thanks for sharing. You’re not alone.</div>
  </form>
  
    <a href="https://atleastidont.myshopify.com/" target="_blank" rel="noopener" class="product-promo-link"
        onclick="trackLinkClick('Shop Link - Image', 'https://atleastidont.myshopify.com/');">
    <img src="assets/epstein-shirts-product-shots-00.png" alt="Collection of Epstein Didn't Kill Himself and Pedophile Island shirts." class="product-promo-image">
  </a>

  
<div class="social-icons">
  <a href="https://www.instagram.com/atleastimnotfuckingkids" target="_blank" rel="noopener" aria-label="Follow us on Instagram"
    onclick="trackLinkClick('Social Icon', 'Instagram');">
  <i class="fab fa-instagram"></i>
 </a>
  <a href="https://x.com/dontfuckkids" target="_blank" rel="noopener" aria-label="Follow us on X (Twitter)"
    onclick="trackLinkClick('Social Icon', 'X (Twitter)');">
  <i class="fab fa-x-twitter"></i>
 </a>
</div>


  <footer>
     <p>This website is satire. We’re not endorsing anything illegal, we’re condemning it.<br>
     Epstein didn’t kill himself.</p>
  </footer>

  <script>
     function trackButtonClick(buttonName) {
       gtag('event', 'click', {
          'event_category': 'engagement',
          'event_label': buttonName
       });
     }

     function trackLinkClick(linkName, linkUrl) {
       gtag('event', 'click', {
          'event_category': 'navigation',
          'event_label': linkName,
          'link_url': linkUrl 
       });
     }

            function trackFormSubmit(formName) {
                gtag('event', 'form_submit', { 
                    'event_category': 'engagement',
                    'event_label': formName
                });
            }


     const sins = <?php echo json_encode($sins); ?>;

     function stripTrailingPeriod(text) {
       return text.replace(/\.\s*$/, '').trim();
     }

     
     function cleanInputForInjection(text) {
       const safeCharsRegex = /[^a-zA-Z0-9 .,!?"'_-]/g;
       return text.replace(safeCharsRegex, '');
     }

     
     const bannedWords = [
       'nigger', 'niggers',
       'negro', 'negros', 'negroes',
       'negress', 'negresses', 'negra', 'negras',
       'spic', 'spics', 'spick', 'spik', 'spicks', 'spiks',
       'chink', 'chinks', 'gook', 'gooks', 'kike', 'kikes'
     ];

     const bannedWordRegexes = bannedWords.map(word => new RegExp('\\b' + word + '\\b', 'i'));



     // function isSingleSentence(text) {
     //  return (text.match(/\./g) || []).length <= 1;
     // }

     function generate() {
       if (!Array.isArray(sins) || sins.length === 0) {
          document.getElementById("output").innerText = "No confessions yet.";
          return;
       }
       const sin = sins[Math.floor(Math.random() * sins.length)];
       const cleanSin = stripTrailingPeriod(sin);
       document.getElementById("output").innerText = `${cleanSin}... but at least I'm not fucking kids.`;
     }

     function submitSin(e) {
       e.preventDefault();
       const input = document.getElementById("newSin");
       let newSin = input.value.trim();
       newSin   = cleanInputForInjection(newSin);
       newSin   = stripTrailingPeriod(newSin);
       
       for (const regex of bannedWordRegexes) {
          if (regex.test(newSin)) {
            alert("chill with the racist shit please");
            return;
          }
       }

       const formData = new FormData();
       formData.append("sin", newSin);

       fetch("submit_sin.php", {
          method: "POST",
          body: formData
       })
       .then(res => {
          if (!res.ok) throw new Error();
          return res.text();
       })
       .then(() => {
          document.getElementById("confirmation").style.display = "block";
          input.value = "";
          setTimeout(() => {
            document.getElementById("confirmation").style.display = "none";
            location.reload();
          }, 3000);
      })
      .catch(() => {
          alert("Submission failed. Try again or say something less horrifying.");
      });
     }

     const websiteUrl = 'https://atleastimnotfuckingkids.com/';

     function getShareText() {
       return document.getElementById("output").innerText;
     }


     const subtitles = [
       "Absolution, limited offer.",
       "It’s not great, but it’s not that.",
       "Because someone has to draw a line.",
       "You are the content.",
       "Peak 2025 energy.",
       "Satire, probably.",
       "Morals.exe has encountered an error.",
       "Morality, downgraded.",
       "You’ve seen worse on Twitter.",
       "It speaks for itself.",
       "You’ve done worse.",
       "The bar is subterranean.",
       "Context matters.",
       "This isn’t even rock bottom."
     ];

     window.onload = function () {
      generate();
      const sub = subtitles[Math.floor(Math.random() * subtitles.length)];
      document.getElementById("subtitleText").innerText = sub;
     }
  </script>
</body>
</html>