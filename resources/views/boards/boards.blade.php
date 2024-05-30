<div class="mt-4">
    @if (isset($boards))
        <ul class="list-none">
            @foreach ($boards as $board)
                <div>
                    <div>
                        {{ $board->user_name }}
                        {{ (new \Carbon\Carbon($board->created_at))->format('Y年m月d日 h:i') }}
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{{ nl2br(e($board->message)) }}</p>
                    </div>
                    <div>
                        {{-- 投稿削除ボタンのフォーム --}}
                        <form method="POST" action="{{ route('boards.destroy', $board->message_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error btn-sm normal-case" 
                                    onclick="return confirm('Delete id = {{ $board->message_id }} ?')">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $boards->links() }}
    @endif
</div>