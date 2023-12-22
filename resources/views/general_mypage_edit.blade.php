<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .number_group {
            display: flex;
        }

        .number {
            padding-right: 20px;
        }

        .open {
            cursor: pointer;
        }

        #pop-up {
            display: none;
        }

        .overlay {
            display: none;
        }

        #pop-up:checked+.overlay {
            display: block;
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.6);
        }

        .window {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 90vw;
            max-width: 360px;
            padding: 20px;
            height: 300px;
            background-color: #fff;
            border-radius: 4px;
            align-items: center;
            transform: translate(-50%, -50%);
        }

        .close {
            position: absolute;
            top: 4px;
            right: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <img src=" {{ asset('storage/' . $company->icon_url) }}
"width="200px" height="200px" alt="User Icon">

    <label class="open" for="pop-up">画像を変更</label>
    <input type="checkbox" id="pop-up">
    <div class="overlay">
        <div class="window">
            <label class="close" for="pop-up">閉じる</label>
            <h3>変更する画像を選択してください</h3>
            <form action="{{ route('general_img.edit',['id' => $company->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file" name="img_path">
                <p><input type="submit" value="変更"></p>
            </form>
        </div>
    </div>

    <form action="{{ route('user_edit.store', $company->id) }}" method="POST">
        @csrf
        @method('PUT')
        <p>名前:<input type="text" name="name" value="{{ $company->name }}"></p>
        <p>ひとこと:<input type="text" name="bio" value="{{ $company->bio }}"></p>
        <p><input type="submit" value="変更"></p>
    </form>


</body>

</html>
