<?php

$xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./Lab1-2.css" />
</head>

<body>
    <div class="wrapper">
        <header class="header">
            <div class="container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Сообщество</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Пользователи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Новое</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
        <main class="main">
            <div class="container">
                <a class="add-post" href="create.php">Добавить пост</a>
                <div class="main-wrap">
                    <div class="main-content">
					<?php
						foreach ($xml->item as $item) {
					?>
						<a class="blog-link" href="index.php?id=<?= $item['id']?>">
							<div class="blog-item">
								<div class="avatar">
									<div class="img-wrap">
										<img src="./profile-icon.svg" alt="profile-icon">
									</div>
								</div>
								<div class="blog-content">
									<h3 class="blog-title"><?= $item->title ?></h3>
									<div class="blog-actions">
										<div class="actions">
											<div class="action">
												<div class="action-img">
													<img src="./like.svg" alt="">
												</div>
												<span class="action-count">
													5
												</span>
											</div>
											<div class="action">
												<div class="action-img">
													<img src="./repost.svg" alt="">
												</div>
												<span class="action-count">
													4
												</span>
											</div>
											<div class="action">
												<div class="action-img">
													<img src="./comment.svg" alt="">
												</div>
												<span class="action-count">
													1
												</span>
											</div>
										</div>
										<span><b>Edit Date:</b> <?= $item["editDate"] ?></span>
										<!-- <a style="color: #000000" href="update.php?id=<?= $item['id']?>">Edit</a>
										<a style="color: #000000" href="delete.php?id=<?= $item['id']?>">Delete</a> -->
										<span class="username">
											Имя Пользователя
										</span>
									</div>
								</div>
							</div>
						</a>
					<?php
						}
					?>
                    </div>
                    <div class="ad-bar">
                        <div class="bar-block">
                            <span class="bar-text">Здесь могла быть ваша реклама</span>
                        </div>
                        <div class="bar-block">
                            <span class="bar-text">AdBlock</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="footer">
            <div class="container">
                <nav class="nav">
                    <ul class="nav-list">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Сообщество</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Пользователи</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Новое</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </footer>
    </div>
</body>

</html>

