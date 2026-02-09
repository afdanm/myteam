@php
    $sub_title = "Interaksi | " . $board->title;
@endphp

@extends('layouts.backend.main', [
    'title' => 'Board Chat | ' . config('app.name'),
    'sub_title' => $sub_title
])

@section('container')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                <h5>{{ $sub_title }}</h5>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-body d-flex flex-column" style="height: 650px;">

                    {{-- CHAT BOX --}}
                    <div id="chat-box"
                         class="flex-grow-1 mb-3"
                         style="overflow-y:auto;border:1px solid #e5e7eb;padding:15px;border-radius:8px;background:#fafafa;">
                    </div>

                    {{-- CHAT FORM --}}
                    <form id="chat-form">
                        @guest
                            <input type="text"
                                   name="nama"
                                   class="form-control mb-2"
                                   placeholder="Nama Anda"
                                   required>
                        @else
                            <input type="hidden" name="nama" value="{{ auth()->user()->username }}">
                        @endguest

                        <div class="d-flex gap-2">
                            <textarea name="pesan"
                                      class="form-control"
                                      placeholder="Tulis pesan..."
                                      rows="2"
                                      required></textarea>
                            <button class="btn btn-primary px-4">
                                Kirim
                            </button>
                        </div>
                    </form>

                    {{-- BACK --}}
                    <div class="mt-4">
                        <a href="{{ route('boards.index') }}"
                           class="btn btn-light text-primary fw-semibold d-inline-flex align-items-center gap-2 shadow-sm"
                           style="background-color:#f4f0ff;">
                            <i data-feather="arrow-left"></i>
                            Back to Boards
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
const chatBox = document.getElementById('chat-box');
const chatForm = document.getElementById('chat-form');

function formatDate(dateStr) {
    const d = new Date(dateStr);
    return `${d.getHours().toString().padStart(2,'0')}:${d.getMinutes().toString().padStart(2,'0')} - ${d.toLocaleDateString('id-ID')}`;
}

function appendChat(chat) {
    const div = document.createElement('div');
    div.classList.add('mb-3');

    div.innerHTML = `
        <div class="d-flex justify-content-between">
            <strong>${chat.nama}</strong>
            <small class="text-muted">${formatDate(chat.created_at)}</small>
        </div>
        <div class="mt-1">${chat.pesan}</div>
    `;

    chatBox.appendChild(div);
}

function fetchChats() {
    fetch("{{ route('boards.chat.fetch', $board) }}")
        .then(res => res.json())
        .then(chats => {
            chatBox.innerHTML = '';
            chats.forEach(appendChat);
            chatBox.scrollTop = chatBox.scrollHeight;
        });
}

chatForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const data = new FormData(chatForm);

    fetch("{{ route('boards.chat.store', $board) }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: data
    })
    .then(res => res.json())
    .then(chat => {
        chatForm.reset();
        appendChat(chat);
        chatBox.scrollTop = chatBox.scrollHeight;
    });
});

fetchChats();
setInterval(fetchChats, 3000);
</script>
@endsection
