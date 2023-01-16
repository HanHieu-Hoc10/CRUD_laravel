<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap');

* {
    box-sizing: border-box
}

body {
    font-family: 'Noto Sans JP', sans-serif;
}

.home-container {
    max-width: 900px;
    margin: 0 auto;
}

h1,
label {
    color: DodgerBlue;
    text-align: center;
}

input[type=text],
input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    width: 100%;
    resize: vertical;
    padding: 15px;
    border-radius: 15px;
    border: 0;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
}

input[type=text]:focus,
input[type=password]:focus {
    outline: none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity: 1;
}

.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

.signupbtn {
    float: left;
    width: 100%;
    border-radius: 15px;
    border: 0;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.2);
}

.container {
    padding: 16px;
}

.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
</style>

<body>
    @auth
    <p>đăng nhập thành công</p>
    <div class="home-container">
        <form action="/logout" method="POST">
            @csrf
            <button>Log out</button>
        </form>

        <div>
            <h2>Create a new post</h2>
            <form action="/create-post" method="POST">
                @csrf
                <input type="text" name="title" placeholder="title">
                <textarea name="body" id="" placeholder="body content..."></textarea>
                <button type="submit">Save Post</button>
            </form>
        </div>
        <div>
            <h2>All Posts</h2>
            @foreach($posts as $post)
                <div style="background-color: gray; border: 1px solid #151515; padding-top: 10px">
                    <h3>
                       Title: {{$post['title']}} by {{$post -> user->name}}
                    </h3>
                    <hr />
                    <p>Content: {{$post['body']}}</p>
                    <p><a href="/edit-post/{{$post->id}}">Edit post</a></p>
                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>DELETE</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="home-container">
        <h1>Form Đăng Ký</h1>
        <form action="/register" method="POST">
            @csrf
            <div class="container">
                <hr>
                <label for="email"><b>Full name</b></label>
                <input type="text" name="name" placeholder="Nhập họ và tên"></input>
                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Nhập Email" name="email">
                <label for="password"><b>Mật Khẩu</b></label>
                <input type="password" placeholder="Nhập Mật Khẩu" name="password">
                <!-- <label for="password-repeat"><b>Nhập Lại Mật Khẩu</b></label> -->
                <!-- <input type="password" placeholder="Nhập Lại Mật Khẩu" name="password-repeat"> -->
                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Nhớ Đăng Nhập
                </label>
                <div class="clearfix">
                    <button type="submit" class="signupbtn">Sign Up</button>
                </div>
            </div>
        </form>
    </div>

    <div class="home-container">
        <h1>Login</h1>
        <form action="/login" method="POST">
            @csrf
            <div class="container">
                <hr>
                <label for="password"><b>Nhập tên</b></label>
                <input type="text" name="loginname" placeholder="Nhập họ và tên"></input>
                <label for="password"><b>Mật Khẩu</b></label>
                <input type="password" placeholder="Nhập Mật Khẩu" name="loginpassword">
                <div class="clearfix">
                    <button type="submit" class="signupbtn">Login</button>
                </div>
            </div>
        </form>
    </div>
    @endauth

</body>

</html>
