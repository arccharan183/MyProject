<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture News</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
      }
      .header {
        background-color: #4CAF50;
        color: white;
        text-align: center;
        padding: 20px;
      }
      .news-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        padding: 20px;
      }
      .news-card {
        width: 45%;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.2);
        cursor: pointer;
        position: relative;
      }
      .news-card:hover {
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.3);
      }
      .news-card img {
        width: 100%;
        height: auto;
      }
      .news-card h2 {
        font-size: 18px;
        margin: 10px 0;
      }
      .news-card p {
        font-size: 14px;
        margin: 10px 0;
      }
      .view-source-btn {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 5px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
      }
      .news-card:hover .view-source-btn {
        opacity: 1;
      }
	  .back-to-home {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
      }
      .back-to-home:hover {
        background-color: #357a38;
      }
      #clock {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
      }
      #date {
        font-size: 18px;
      }
    </style>
  </head>
  <body>
        <div class="header">
        <div class="logo">
            <img src="nit-logo.png">
      <h1>Latest Agriculture News</h1>
      <div id ="clock"></div>
      <div id="date"></div>
    </div>
        </div>
    <div class="news-container"></div>
    <button class="back-to-home" onclick="location.href='demo2.php';">Back to Home</button>
    <script>
      function updateClock() {
var now = new Date();
var clock = document.getElementById("clock");
var date = document.getElementById("date");
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds();
var day = now.getDate();
var month = now.getMonth() + 1;
var year = now.getFullYear();
hours = (hours < 10 ? "0" : "") + hours;
minutes = (minutes < 10 ? "0" : "") + minutes;
seconds = (seconds < 10 ? "0" : "") + seconds;
day = (day < 10 ? "0" : "") + day;
month = (month < 10 ? "0" : "") + month;
clock.innerHTML = hours + ":" + minutes + ":" + seconds;
date.innerHTML = day + "/" + month + "/" + year;
setTimeout(updateClock, 1000);
}
updateClock();
      const apiKey = "24e38f2c8b7e49b3919047e71631d393";
      const apiUrl = `https://newsapi.org/v2/everything?q=agriculture&from=${getYesterday()}&sortBy=publishedAt&apiKey=${apiKey}`;
      
      // Get yesterday's date
      function getYesterday() {
        const today = new Date();
        const yesterday = new Date(today);
        yesterday.setDate(yesterday.getDate() - 1);
        return yesterday.toISOString().split('T')[0];
      }
      
      // Fetch news articles from API and display them on the page
      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          const articles = data.articles;
          const newsContainer = document.querySelector(".news-container");
          articles.forEach(article => {
            const {urlToImage, title, description, url} = article;
            const newsCard = `
              <div class="news-card">
               

                <img src="${urlToImage || 'https://theagrotechdaily.com/wp-content/uploads/2022/04/SustainableAgricultureTechnology-scaled-1.jpg'}" alt="Article image">
                <h2>${title}</h2>
                <p>${description}</p>
                <a href="${url}" target="_blank">Read more</a>
              </div>
            `;
            newsContainer.innerHTML += newsCard;
          });
        })
        .catch(error => console.log(error));
    </script>
  </body>
</html>
