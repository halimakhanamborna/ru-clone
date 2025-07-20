<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Rajshahi</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images.png" alt="University Logo">
            <span>University of Rajshahi</span>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="governance.html">GOVERNANCE</a></li>
                <li><a href="administration.html">ADMINISTRATION</a></li>
                <li><a href="iqac.html">IQAC</a></li>
                <li><a href="academic.html">ACADEMIC</a></li>
                <li><a href="facilities.html">FACILITIES</a></li>
                <li><a href="admission.html">ADMISSION</a></li>
                <li><a href="publications.html">PUBLICATIONS</a></li>
                <li><a href="online-services.html">ONLINE SERVICES</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <div class="slider">
            <img src="admin-building.jpg" alt="Administration Building">
        </div>
        <div class="hero-text">
            <h1>Rajshahi University Administration Building</h1>
            <p>Administration Building</p>
            <a href="#" class="btn">READ MORE</a>
        </div>
    </section>

    <section class="info-cards">
        <div class="card slide-in-left"><i class="fas fa-graduation-cap"></i><h2><a href="convo.html">Convocation</h2></a><p>12th, 2025</p></div>
        <div class="card slide-in-left"><i class="fas fa-user-graduate"></i><h2><a href="Admn.html">Admission</h2></a><p>2024-2025</p></div>
        <div class="card slide-in-right"><i class="fab fa-facebook"></i><h2><a href="facebook-page.html">Facebook</h2></a></div>
        <div class="card slide-in-right"><i class="fab fa-linkedin"></i><h2><a href="linkedin.html">Linkedin</h2></a></div>
    </section>

    <section class="welcome">
        <div class="welcome-box">
            <h2>Welcome to the University of Rajshahi</h2>
            <p>The University of Rajshahi is one of the largest universities in the country and the largest with the highest seat of learning in the northern region of Bangladesh. After its foundation on July 6, 1953, the university has been providing higher education and research. The university is located on a 753-acre campus on the green premises of Motihar, which is very close to the mighty river Padma and seven km east of the Rajshahi City Center.

                <p> The necessity of a university in the northern part of East Pakistan was felt immediately after the creation of Pakistan. These areas were comparatively lagging behind in higher education, and the University of Dhaka, then the only university of its kind in the country, being situated in the capital, was not very easily accessible to the students of this part. Following a popular demand for a university in this region, the government prepared a feasibility report, and Rajshahi was found suitable for establishing the same. The Rajshahi University Act 1953 (East Bengal Act XV of 1953) was passed by the East Pakistan provincial assembly on March 31, 1953. Bara Kuthi, an 18th century Dutch trading house, was made the administration building. Dr. Itrat Hossain Zeberi was the first Vice-Chancellor of the University. Its normal academic activities began in 1954. During the early days of its inception, classes were held at Rajshahi Government College. In 1961, the university moved to its present campus.</p>
                 
                 <p>The university’s 59 departments are organized into twelve faculties. It has six institutes, of which two (IBA and IER) have undergrad and postgraduate programs. The University of Rajshahi is considered as one of the top research universities in Bangladesh. Recently, researchers from this university have made substantial contributions and played a key role in bringing back the ancient Bangladeshi Muslin fiber. The researchers of this university have also created the country’s first and only “snake database”, including snakes’ venom and their toxicity. The university has a strong alumni community around Bangladesh and abroad.</p>
        </div>
    </section>

    
    <section class="latest-section">
    <div class="latest-box"><div class="container">
      <div class="latest-events"><h2>Latest Events</h2>
        <?php
        $res = $conn->query("SELECT * FROM events ORDER BY date DESC LIMIT 3");
        while ($e = $res->fetch_assoc()):
        ?>
          <div class="event">
            <a href="uploads/<?= htmlspecialchars($e['image']) ?>" target="_blank">
              <img src="uploads/<?= htmlspecialchars($e['image']) ?>" alt="">
            </a>
            <div class="event-text">
              <h3><?= htmlspecialchars($e['title']) ?></h3>
              <p><?= date("d-m-Y",strtotime($e['date'])) ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

      <div class="latest-notices"><h2>Latest Notices</h2><ul>
        <?php
        $res2 = $conn->query("SELECT * FROM notices ORDER BY date DESC LIMIT 8");
        while ($n = $res2->fetch_assoc()):
          $link = $n['pdf_file']
            ? '<a href="uploads/'.htmlspecialchars($n['pdf_file']).'" target="_blank">' . htmlspecialchars($n['content']) . '</a>'
            : htmlspecialchars($n['content']);
        ?>
          <li><?= date("d M",strtotime($n['date'])) ?> - <?= $link ?></li>
        <?php endwhile; ?>
      </ul></div>
    </div>

   
    </div>
  </section>

      
    

      
    <footer>
        <p>&copy; 2025 University of Rajshahi. All rights reserved.</p>
    </footer>
</body>
</html>



