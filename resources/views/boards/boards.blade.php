<!DOCTYPE html>
<html lang="jp">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .delete-button {
            background: lightgray;
            border: none;
            color: black;
            cursor: pointer;
            display: flex;
            align-items: center;
            border-radius: 8px; /* 角を丸くする */
            padding: 8px 9px; /* パディングを追加してボタンを大きくする */
            transition: background-color 0.3s; /* 背景色の変化にアニメーションを追加 */
        }
        .delete-button:hover {
            background: darkgray; /* ホバー時の背景色を変更 */
        }
        .delete-button svg {
            width: 25px; /* アイコンのサイズを調整 */
            height: 25px;
            margin-right: 1px; /* アイコンとテキストの間のスペース */
        }
    </style>
</head>
<body>
<div class="sm:grid sm:grid-cols-3 sm:gap-10">
    @if (isset($boards))
        <ul class="list-none">
            @foreach ($boards as $board)
            <li class="p-4 bg-white mb-4 rounded shadow">
                <div>
                    <div class="bg-gray-100 p-2">
                        <span class="text-sm">
                            {{ $board->user_name }}
                            {{ (new \Carbon\Carbon($board->created_at))->format('Y年m月d日 h:i') }}
                        </span>
                    </div>
                    
                    <div class="p-4 rounded">
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{{ nl2br(e($board->message)) }}</p>
                    </div>
                    <div>
                        @if (Auth::id() == $board->user_number)
                        {{-- 投稿削除ボタンのフォーム --}}
                        <form method="POST" action="{{ route('boards.destroy', $board->message_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button" 
                                    onclick="return confirm('削除するメッセージは id {{ $board->message_id }} でよろしいですか?')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                                Delete
                            </button>
                        </form>
                        @endif
                    </div>
                    <div>
                        @if (Auth::id() !== $board->user_number)
                        {{-- お気に入り／お気に入り解除ボタン --}}
                        @include('user_favorite.favorite_button', ['id' => $board->message_id])
                        @endif
                    </div>
                </div>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $boards->links() }}
    @endif
</div>
</body>
</html>