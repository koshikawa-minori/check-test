@extends('layouts.app')

@section('content')
  <h1>管理画面</h1>

  <p>接続DB: {{ $dbName }}　全件数: {{ $totalAll }}</p>
  <p>現在の条件:
    gender={{ var_export($gender,true) }},
    category_id={{ var_export($category_id,true) }},
    date={{ var_export($date,true) }},
    match={{ $match }}
  </p>

  <form method="POST" action="/logout" style="margin-top:1rem;">
    @csrf
    <button type="submit">ログアウト</button>
  </form>

  <form method="GET" action="{{ route('admin.index') }}" class="mb-4" style="margin-top:1rem;">
    <div>
      <label>姓</label>
      <input type="text" name="last_name" value="{{ old('last_name', $last_name ?? '') }}">
    </div>
    <div>
      <label>名</label>
      <input type="text" name="first_name" value="{{ old('first_name', $first_name ?? '') }}">
    </div>
    <div>
      <label>フルネーム（姓+名）</label>
      <input type="text" name="full_name" value="{{ old('full_name', $full_name ?? '') }}">
    </div>
    <div>
      <label>メール</label>
      <input type="text" name="email" value="{{ old('email', $email ?? '') }}">
    </div>
    <div>
      <label>性別</label>
      <select name="gender">
        <option value="" {{ ($gender==='') ? 'selected' : '' }}>全て</option>
        <option value="1" {{ ($gender==='1') ? 'selected' : '' }}>男性</option>
        <option value="2" {{ ($gender==='2') ? 'selected' : '' }}>女性</option>
        <option value="3" {{ ($gender==='3') ? 'selected' : '' }}>その他</option>
      </select>
    </div>
    <div>
      <label>お問い合わせ種類</label>
      <select name="category_id">
        <option value="" {{ ($category_id==='') ? 'selected' : '' }}>全て</option>
        @foreach($categories as $cat)
          <option value="{{ $cat->id }}" {{ (string)$category_id === (string)$cat->id ? 'selected' : '' }}>
            {{ $cat->content }}
          </option>
        @endforeach
      </select>
    </div>
    <div>
      <label>日付</label>
      <input type="date" name="date" value="{{ old('date', $date ?? '') }}">
    </div>
    <div>
      <label>一致方法</label>
      <select name="match">
        <option value="partial" {{ ($match ?? 'partial')==='partial' ? 'selected' : '' }}>部分一致</option>
        <option value="exact"   {{ ($match ?? 'partial')==='exact'   ? 'selected' : '' }}>完全一致</option>
      </select>
    </div>
    <div>
      <button type="submit">検索</button>
      <a href="{{ route('admin.index') }}">リセット</a>
    </div>
  </form>

  <p>該当件数：{{ $items->total() }} 件</p>

  @if($items->total() === 0)
    <p>該当するデータはありません。</p>
  @else
    <table border="1" cellspacing="0" cellpadding="6">
      <thead>
        <tr>
          <th>ID</th>
          <th>姓</th>
          <th>名</th>
          <th>性別</th>
          <th>メール</th>
          <th>種類</th>
          <th>作成日</th>
        </tr>
      </thead>
      <tbody>
        @foreach($items as $it)
          <tr>
            <td>{{ $it->id }}</td>
            <td>{{ $it->last_name }}</td>
            <td>{{ $it->first_name }}</td>
            <td>
              @switch($it->gender)
                @case(1) 男性 @break
                @case(2) 女性 @break
                @case(3) その他 @break
                @default ー
              @endswitch
            </td>
            <td>{{ $it->email }}</td>
            <td>{{ optional($categories->firstWhere('id', $it->category_id))->content }}</td>
            <td>{{ $it->created_at->format('Y-m-d') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3">
      {{ $items->links() }}
    </div>
  @endif
@endsection
