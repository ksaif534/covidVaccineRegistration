<x-mail::message>
# Vaccine Date Reminder

Dear {{ $user->name }},

Don't forget to take the vaccine doze tommorow at {{ $user->vaccine_slot->vaccination_date }}.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
