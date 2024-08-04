<?php
// 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";
$password = "0000";
$dbname = "game_langking";

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("데이터베이스 연결 실패: " . $conn->connect_error);
}

// 폼 데이터 받기
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];

// 비밀번호 해시화
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL 쿼리 준비
$stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $username, $hashed_password);

// 쿼리 실행
if ($stmt->execute()) {
    echo "회원가입이 완료되었습니다.";
} else {
    echo "회원가입 실패: " . $stmt->error;
}

// 데이터베이스 연결 종료
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>회원가입</title>
    <link rel="stylesheet" href="./02-signup.css" />
</head>
<body>
    <div class="container">
        <div class="member-container">
            <div class="header">
                <div>회원 가입을 위해</div>
                <div>정보를 입력해주세요</div>
            </div>
            <form action="http://localhost/signup_process.php" method="POST">
                <div class="user-info">
                    <div class="user-info-email">
                        <div>* 이메일</div>
                        <input type="email" name="email" required />
                    </div>
                    <div class="user-info-name">
                        <div>* 이름</div>
                        <input type="text" name="username" required />
                    </div>
                    <div class="user-info-pw">
                        <div>* 비밀번호</div>
                        <input type="password" name="password" required />
                    </div>
                    <div class="user-info-pw-check">
                        <div>* 비밀번호 확인</div>
                        <input type="password" name="password_check" required />
                    </div>
                </div>
                <div class="btn">
                    <button type="submit">가입하기</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>