@component('mail::message')
@lang(' اطلاعات شما در سامانه مدارس عشایر کرمان ویرایش شد') <br>

@lang('برای تایید ایمیل روی دکمه زیر کلیک کنید')<br>

@component('mail::button', ['url' =>  route('verification.mail',['token'=>$email_token,'from'=>'edit']) ,'color' => 'gradient'])
        تایید ایمیل
@endcomponent

@lang('اگر دکمه را نمی بینید لینک زیر را در نوار آدرس مرورگر کپی کنید')
<br>
@lang(route('verification.mail',['token'=>$email_token,'from'=>'edit']))
<br>
<br>
<br>
@lang(    'با تشکر')
    {{--سامانه مدارس عشایر کرمان--}}
{{ config('app.name') }}

@endcomponent
