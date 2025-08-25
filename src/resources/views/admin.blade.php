{{-- resources/views/admin.blade.php（抜粋） --}}

@if (session('status'))
  <div class="flash">{{ session('status') }}</div>
@endif

<table class="list">
  <thead>
    <tr>
      <th>ID</th>
      <th>氏名</th>
      <th>メール</th>
      <th>カテゴリ</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach($contacts as $c)
      <tr>
        <td>{{ $c->id }}</td>
        <td>{{ $c->last_name }} {{ $c->first_name }}</td>
        <td>{{ $c->email }}</td>
        <td>{{ optional($c->category)->content }}</td>
        <td>
          {{-- JSなし：アンカーでモーダルを開く --}}
          <a class="btn-detail" href="#detail-{{ $c->id }}">詳細</a>
        </td>
      </tr>

      {{-- ===== モーダル（:target で開閉、JS不要） ===== --}}
      <div id="detail-{{ $c->id }}" class="modal" aria-hidden="true">
        {{-- 背景クリックで閉じる --}}
        <a href="#" class="modal__overlay" aria-label="閉じる"></a>

        <div class="modal__panel" role="dialog" aria-modal="true" aria-labelledby="mt-{{ $c->id }}">
          <header class="modal__header">
            <h3 id="mt-{{ $c->id }}" class="modal__title">お問い合わせ詳細</h3>
            {{-- × ボタンで閉じる（# へ戻す） --}}
            <a href="#" class="modal__close" aria-label="閉じる">×</a>
          </header>

          <div class="modal__body">
            <dl class="kv">
              <div><dt>ID</dt><dd>{{ $c->id }}</dd></div>
              <div><dt>氏名</dt><dd>{{ $c->last_name }} {{ $c->first_name }}</dd></div>
              <div><dt>性別</dt><dd>{{ $c->gender }}</dd></div>
              <div><dt>メール</dt><dd>{{ $c->email }}</dd></div>
              <div><dt>電話</dt><dd>{{ $c->tel }}</dd></div>
              <div><dt>住所</dt><dd>{{ $c->address }}</dd></div>
              <div><dt>建物名</dt><dd>{{ $c->building }}</dd></div>
              <div><dt>カテゴリ</dt><dd>{{ optional($c->category)->content }}</dd></div>
              <div><dt>内容</dt><dd style="white-space: pre-wrap;">{{ $c->content }}</dd></div>
              <div><dt>受付日時</dt><dd>{{ optional($c->created_at)->format('Y-m-d H:i') }}</dd></div>
            </dl>
          </div>

          <footer class="modal__footer">
            <form method="post" action="{{ route('admin.contacts.destroy', $c) }}">
              @csrf
              @method('DELETE')
              {{-- ※要件は「クリックで削除」なので確認ダイアログなし（JS不使用） --}}
              <button type="submit" class="btn-danger">削除する</button>
            </form>
            <a href="#" class="btn-secondary">とじる</a>
          </footer>
        </div>
      </div>
      {{-- ===== /モーダル ===== --}}
    @endforeach
  </tbody>
</table>

<style>
.list { width:100%; border-collapse:collapse; }
.list th, .list td { border:1px solid #ddd; padding:8px; }
.btn-detail { padding:6px 10px; border:1px solid #bbb; background:#fff; text-decoration:none; display:inline-block; }

.flash { margin:10px 0; padding:8px 12px; background:#f0fff4; border:1px solid #b2f5ea; }

/* ===== モーダル（CSSのみ） ===== */
.modal { position:fixed; inset:0; display:none; z-index:50; }
.modal:target { display:block; }
.modal__overlay { position:absolute; inset:0; background:rgba(0,0,0,.4); display:block; }
.modal__panel { position:relative; max-width:680px; margin:5vh auto; background:#fff; border-radius:10px;
  box-shadow:0 10px 30px rgba(0,0,0,.2); overflow:hidden; }
.modal__header, .modal__footer { padding:12px 16px; border-bottom:1px solid #eee; }
.modal__footer { border-top:1px solid #eee; border-bottom:none; display:flex; gap:8px; justify-content:flex-end; }
.modal__title { margin:0; font-size:18px; }
.modal__close { position:absolute; top:8px; right:12px; text-decoration:none; font-size:20px; color:#333; }
.modal__body { padding:16px; max-height:60vh; overflow:auto; }
.kv { display:grid; grid-template-columns: 120px 1fr; gap:8px 12px; }
.kv dt { color:#666; }
.kv dd { margin:0; }

/* ボタン */
.btn-danger { background:#e74c3c; color:#fff; border:none; padding:8px 12px; border-radius:6px; cursor:pointer; }
.btn-secondary { background:#f2f2f2; border:1px solid #ddd; padding:8px 12px; border-radius:6px; text-decoration:none; color:#333; }
</style>
