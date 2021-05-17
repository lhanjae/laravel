<!DOCTYPE html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<style>
  table {

    width: 100%;
    border: 1px solid #444444;
    border-collapse: collapse;
    margin: auto;

  }
  tr {
    height: 40px;
  }
  th, td {
    border: 1px solid #444444;
    padding: 5px;
  }
  input{
    width: 50%;
    height: 100%;
  }
</style>
<html>
<head>
    <title></title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1 style="text-align:center;">글 작성</h1>
    <table>
    <form method="POST" action="/board">
        @csrf
        <input type="hidden" name="board_date" value="<?=now()?>">
        <tr>
        <td>
            <lavel style="height:100px;">작성자</lavel>
            <input type="text" name="writer" placeholder="작성자" maxlength="25" required autocomplete="off">
        </td>
        </tr>

        <tr>
            <td>
                <lavel>제 목</lavel>
                <input type="text" name="title" placeholder="제목" maxlength="60" required autocomplete="off">
            </td>
        </tr>

        <tr>
            <td>
                <lavel style="vertical-align: top;">내 용</lavel>
                <textarea name="comment" placeholder="내용" style="height:100px; width:50%;" maxlength="250" required autocomplete="off"></textarea>
            </td>
        <tr>
    </table>
        <div stlye="text-align: center;">
            <button><a href="/board">목록</a></button>
            <button type="submit">글 작성</button>
        </div>
    </form>
</body>
</html>
