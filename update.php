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
    <?php
	date_default_timezone_set('Europe/Moscow');

	function checkTitleValidity($value) {
		$value = trim($value);

		if (empty($value)) {
			return "Поле пустое!";
		}
		elseif (strlen($value) < 4) {
			return "Минимум 4 символа!";
		}
		elseif (strlen($value) > 120) {
			return "Максимум 30 символов!";
		}
		else if (!preg_match("/^[a-z\x{0410}-\x{042F}0-9 ]+$/ui", $value)) {
			return "Запрещено использование спец. символов!";
		}

		return true;
	}

	function checkTextValidity($value) {
		$value = trim($value);

		if (empty($value)) {
			return "Поле пустое!";
		}
		elseif (strlen($value) < 4) {
			return "Минимум 4 символа!";
		}

		return true;
	}

    $id = 0;
    $title = '';
    $text = '';
    $latest_edit_date = date('d-m-y');
	$current_edit_date = date('d-m-y');

	$titleError = "";
	$textError = "";

    $xml = simplexml_load_file("data.xml") or die("Error: Cannot create object");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $id = $_GET['id'];

        foreach ($xml->item as $item) {
            if ($item['id'] == $id) {
                $title = $item->title;
                $text = $item->text;
                $latest_edit_date = $item['editDate'];
                break;
            }
        }
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$sendedTitle = $_POST['title'];
		$sendedText = $_POST['text'];

		$titleIsValid = checkTitleValidity($sendedTitle);
		$textIsValid = checkTextValidity($sendedText);

		$id = $_GET['id'];

        foreach ($xml->item as $item) {
            if ($item['id'] == $id) {
                $title = $item->title;
                $text = $item->text;
                $latest_edit_date = $item['editDate'];
                break;
            }
        }

		if (gettype($titleIsValid) == "string") {
			$titleError = $titleIsValid;
		}
		if (gettype($textIsValid) == "string") {
			$textError = $textIsValid;
		}

		if ($titleIsValid === true && $textIsValid === true) {
			$id = $_POST['id'];
			foreach ($xml->item as $item) {
				if ($item['id'] == $id) {
					$item->title= $_POST['title'];
					$item->text = $_POST['text'];
					$item["editDate"] = $_POST['editDate'];
					break;
				}
			}
			$xml->saveXML('data.xml');

			header("Location: http://localhost/lab/list.php", TRUE, 301);
			exit( );
		}
        
    }
    ?>

	<div class="wrapper">
		<header class="header">
			<div class="container">
				<nav class="nav">
					<ul class="nav-list">
						<li class="nav-item">
							<a class="nav-link" href="list.php">Главная</a>
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
				<div class="center">
					<div class="form-wrap">
						<form method="POST" action="update.php?id=<?= $id ?>">
							<div class="field-wrap">
								<div class="form-field">
									<label class="form-label" for="title">Название поста:</label>
									<input id="title" class="form-input" type="text" name="title" value="<?= $title ?>" />
								</div>
								<div class="error-container"><?php echo $titleError ?></div>
							</div>
							<div class="field-wrap">
								<div class="form-field">