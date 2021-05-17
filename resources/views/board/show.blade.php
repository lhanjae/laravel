<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<title>상세보기</title>
</head>
<style>
  table {

    width: 100%;
    border: 1px solid #444444;
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid #444444;
    padding: 5px;
  }
</style>
<!-- 다음게시물 이전게시물   현재 num값보다 작은수의 큰수가 이전게시물 현재 num값보다 큰수의 작은수가 다음게시물 -->
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
	<div style="margin-top:50px;">
		<div>
			<div>
				<div>
					<table>
                        <thead>
							<tr>
								<th scope="colgroup" colspan="8" style="background-color:#A5ABB0; text-align:center">
								<h3>{{ $rows->title }}</h3>
								</th>
							</tr>
							<tr style="height:50px">
								<th scope="row">작성일</th>
								<td headers="dates">{{ $rows->board_date->addHours(9) }}</td>
								<th scope="row">작성자</th>
								<td headers="writer">{{ $rows->writer }}</td>
								<th  scope="row">조회수</th>
								<td >{{ $rows->board_view }}</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="8" style="height:200px">{{ $rows->comment }}</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="8" class="m8">
									<div style="float:right">
										<button><a href="/board/{{ $rows->id }}/edit">수정</a></button>
                                    </div>
                                    <form method="POST" action="/board/{{ $rows->id }}">
                                        <input type="hidden" name="writer" value="{{ $rows->writer }}">
                                        <input type="hidden" name="title" value="{{ $rows->title }}">
                                        <input type="hidden" name="comment" value="{{ $rows->comment }}">
                                        <input type="hidden" name="board_date" value="{{ $rows->board_date }}">
                                    @method('DELETE')
                                    @csrf
										<button type="submit" style="float:right">삭제</button>
									</form>
								</td>
							</tr>
						</tfoot>
					</table>
                    <div style="text-align:center">
                    <br>
                        <td colspan="6">
                            <button><a href="/board">목록</a></button>
                        </td>
                        {{-- <div style="float:left">
                            <a href="#">다음게시물</a>
                        </div>
                        <div style="float:right">
                            <a href="#">이전게시물</a>
                        </div> --}}
                    </div>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
