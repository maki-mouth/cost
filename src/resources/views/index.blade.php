@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<form class="add-form" action="/costs" method="POST">
@csrf
<div class="add-form-container">
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" >{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="text" name="amount" placeholder="金額" value="{{ old('amount') }}" />
        <input type="text" name="memo" placeholder="メモ" value="{{ old('memo') }}" />
        <button type="submit">追加</button>
    </div>
</form>
<div class="list">
        <table class="list-table">
            <tr>
                <th>日付</th>
                <th>カテゴリ</th>
                <th>金額</th>
                <th>メモ</th>
                <th></th>
                <th></th>
            </tr>
            @foreach ($costs as $cost)
            <tr>
                <form action="/costs/update" method="POST">
                    @csrf
                    @method('PATCH')
                    <td>
                        <input class="update-form__item-input" type="text" name="created_at" value="{{ $cost->created_at->format('Y/m/d') }}">
                    </td>
                    <td>
                        <select name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if ($category->id == $cost->category_id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="update-form__item-input" type="number" name="amount" value="{{ $cost->amount }}">円
                    </td>
                    <td>
                        <input class="update-form__item-input" type="text" name="memo" value="{{ $cost->memo }}">
                    </td>
                    <td class="update-buttons">
                                <input type="hidden" name="id" value="{{ $cost->id }}">
                                <button type="submit">更新</button>
                    </td>
                </form>
                    <td class="delete-buttons">
                        <form action="/costs/delete" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $cost->id }}">
                            <button type="submit">削除</button>
                        </form>
                    </td>
            </tr>
            @endforeach
        </table>
    <p>合計： {{ number_format($totalAmount) }}円</p>
</div>
@endsection