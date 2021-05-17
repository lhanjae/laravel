<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<title>게시판 목록</title>
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
<?php
$page = $rows->currentPage();
?>
<body style="">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1 style="text-align:center;">게시판 목록</h1>
	<div  style="margin-top:50px;">
		<!-- 내용시작 -->
		<div>

			<div>
				<div>
					<em>전체 : {{ $rows->total() }}개 (<b>{{ $rows->currentPage() }} / {{ $rows->lastPage() }} page</b>)</em>
					<div style="text-align:center;">
                    <form method="get" action="/board">
                    @csrf
						<div>
							<select name="sField" id="sField" title="검색범위 선택">
                                <option value="title" >제목</option>
                                <option value="comment" >내용</option>
							</select>
						</div>
						<div>
							<input type="text" placeholder="검색어를 입력해주세요" name="sWord" id="sWord" maxlength="20"
                            value=""/>
							<button type="submit">검색</button>
						</div>
                    </form>
                    <button style="float:right;"><a href="/board/create">글쓰기</a></button>
					</div>
				</div>
                <div style="">
                    <table >
                        <thead>
                            <tr style="background-color:#A5ABB0;">
                                <th scope="col" width="40px" style="text-align:center;">
                                <select name="numLine" id="numLine" onchange="numLine(this.value)" style="background:transparent; border:none;">
                                    <option value="title" >번호(▼)</option>
								    <option value="comment" >번호(▲)</option>
                                </select>
                                </th>
                                <th scope="col" width="400px" style="text-align:center;">제목</th>
                                <th scope="col" width="150px" style="text-align:center;">작성자</th>
                                <th scope="col" width="70px" style="text-align:center;">작성일자</th>
                                <th scope="col" width="40px" style="text-align:center;">조회수</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 게시글 있을 때 -->
                            @if ($rows->total() > 0)
                            <?php
                            $i=0;
                            ?>
                            @foreach($rows as $row)
                            <?php
                            $limit = ($rows->currentPage() - 1) * 5; //currentPage 현재페이지
                            $viewno = $rows->total() - ($i++ + $limit); // total 총 게시물 수
                            ?>
                            <tr>
                                <th scope="row" style="text-align:center;"><span><?=$viewno?></span></th>
                                <td>
                                    <a href="/board/{{$row->id}}?page={{ $rows->currentPage() }}">{{ $row->title }}</a>
                                </td>
                                <td style="text-align:center;">{{ $row->writer }}</td>
                                {{-- <td style="text-align:center;">{{ $row->created_at->addHours(9) }}</td> --}}
                                <td style="text-align:center;">{{ $row->board_date->addHours(9) }}</td>
                                <td style="text-align:center;">{{ $row->board_view }}</td>
                            </tr>
                            @endforeach
                            @else
                            <!-- 게시글 없을 때 -->
                            <tr>
                                <th scope="row" colspan="5">게시물이 없습니다.</th>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div style="text-align:center;">
                    {{ $rows->withQueryString()->links() }}
                </div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
function numLine(num){
    location.href="/posts?numid="+num;
}
</script>

