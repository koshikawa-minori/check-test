@extends('layouts.app')

@section('header-button')
  <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button class="logout-btn" type="submit">logout</button>
  </form>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/common.css') }}" />
<link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
@endsection

@section('content')


<div class="admin__head">
  <h1>Admin</h1>
</div>

<div class="admin__group">

  <form class="search__group" method="get" action="/admin">
    <input class="search__group-input" type="text" name="keyword"
            value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">

    <div class="search__group-select">
      <div class="search__group--gender">
        <select class="select-item" name="gender" >
          <option value="">性別</option>
          <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
          @foreach($genderMap as $val => $label)
            <option value="{{ $val }}"
              {{ (string)request('gender') === (string)$val ? 'selected' : '' }}>
              {{ $label }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="search__group--category-id">
        <select class="select-item" name="category_id">
          <option value="">お問い合わせの種類</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
              {{ (string)request('category_id') === (string)$cat->id ? 'selected' : '' }}>
              {{ $cat->content }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="search__group--date">
        <input class="input-date" id="date" type="date" name="date" value="{{ old('date', request('date')) }}">
      </div>

      <div class="search__group--btn">
        <button class="search-btn" type="submit">検索</button>
        <button class="search-reset" type="button" onclick="location.href='/admin'">リセット</button>
      </div>
    </div>
  </form>

  <div class="admin__group--tool">
    <div class="tool-export">
      <button type="button"
              onclick="location.href='{{ url('/admin/export') }}?{{ request()->getQueryString() }}'">エクスポート
      </button>
    </div>
    <div class="tool-pagination">
      {{ $contacts->links('pagination::bootstrap-5') }}
    </div>
  </div>
  <table>
    <thead class="table-head">
      <tr>
        <th class="table-col-name">名前</th>
        <th class="table-col-gender">性別</th>
        <th class="table-col-email">メールアドレス</th>
        <th class="table-col-category">お問い合わせ種類</th>
        <th class="table-col-action"></th> {{-- 右端の詳細ボタン用 --}}
      </tr>
    </thead>

    <tbody class="table-body">
      @foreach($contacts ?? [] as $contact)
        <tr>
          <td class="table-col-name">{{ $contact->last_name }}{{ $contact->first_name }}</td>
          <td class="table-col-gender">{{ $genderMap[$contact->gender] ?? $contact->gender }}</td>
          <td class="table-col-email">{{ $contact->email }}</td>
          <td class="table-col-category">{{ optional($contact->category)->content ?? $contact->category_id }}</td>
          <td class="table-col-date">
            <button class="btn-detail" type="button" data-id="{{ $contact->id }}">詳細</button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  @foreach($contacts ?? [] as $contact)
    <div class="modal" id="modal-{{ $contact->id }}">
      <div class="modal-content">
        <button class="close" type="button" data-id="{{ $contact->id }}" aria-label="閉じる">×</button>

        <div class="modal-grid">
          <div class="modal-label">お名前</div>
          <div class="modal-value">{{ $contact->last_name }}{{ $contact->first_name }}</div>

          <div class="modal-label">性別</div>
          <div class="modal-value">{{ $genderMap[$contact->gender] ?? $contact->gender }}</div>

          <div class="modal-label">メールアドレス</div>
          <div class="modal-value">{{ $contact->email }}</div>

          <div class="modal-label">電話番号</div>
          <div class="modal-value">{{ $contact->tel ?? '—' }}</div>

          <div class="modal-label">住所</div>
          <div class="modal-value">{{ $contact->address ?? '—' }}</div>

          <div class="modal-label">建物名</div>
          <div class="modal-value">{{ $contact->building ?? '—' }}</div>

          <div class="modal-label">お問い合わせの種類</div>
          <div class="modal-value">{{ optional($contact->category)->content ?? '—' }}</div>

          <div class="modal-label">お問い合わせ内容</div>
          <div class="modal-value">{!! nl2br(e($contact->detail)) !!}</div>
        </div>

        <div class="modal-actions">
          <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}">
            @csrf
            @method('DELETE')
            <button class="delete" type="submit">削除</button>
          </form>
        </div>
      </div>
    </div>
  @endforeach
</div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-detail').forEach(function (btn){
      btn.addEventListener('click', function () {
        var id =btn.dataset.id;
        var modal =document.getElementById('modal-' + id);
        if (modal) modal.classList.add('is-open');

      });
    });


    document.querySelectorAll('.modal .close').forEach(function (x) {
      x.addEventListener('click', function () {
        var id = x.dataset.id;
        var modal = document.getElementById('modal-' + id);
        if (modal) modal.classList.remove('is-open');
      });
    });

  });
</script>