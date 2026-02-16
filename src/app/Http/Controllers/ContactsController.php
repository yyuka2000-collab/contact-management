<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;
use App\Models\Categories;
use App\Http\Requests\ContactsRequest;

class ContactsController extends Controller
{
    // 入力画面
    public function index()
    {
        // categoriesテーブル取得
        $categories = Categories::all();

        return view('contact', compact('categories'));
    }

    // 確認画面表示
    public function confirm(ContactsRequest $request)
    {
        // バリデーション済みデータを取得（電話番号は結合済み）
        $contact = $request->validated();

        // 確認画面用に元の電話番号フィールドを保持（修正ボタン用）
        $contact['tel_first'] = $request->input('tel_first');
        $contact['tel_second'] = $request->input('tel_second');
        $contact['tel_third'] = $request->input('tel_third');

        // 問い合わせ種類名を取得
        $category = Categories::find($contact['categry_id']);
        $contact['category'] = $category->content;

        // お問い合わせ内容の前後の空白・改行を削除（中間の改行は保持）
        $contact['detail'] = trim($contact['detail']);

        // 入力内容をセッションに保存
        session()->put('contact_input', $request->all());

        return view('confirm', compact('contact'));
    }

    // 入力内容保存
    public function store(Request $request){
        // 確認画面からのデータを再結合
        $data = $request->only([
            'categry_id', 'first_name', 'last_name',
            'gender', 'email', 'address', 'building', 'detail'
        ]);

        // 電話番号を結合
        $data['tel'] = $request->input('tel_first') .$request->input('tel_second') .$request->input('tel_third');

        Contacts::create($data);

        // セッションに保存していた入力内容を削除
        session()->forget('contact_input');

        return view('thanks');
    }

    public function thanks()
    {
        return view('thanks');
    }
}
