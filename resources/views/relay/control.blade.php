<!DOCTYPE html>
<html>
<head>
    <title>Kontrol Relay</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 20px; width: 300px; margin-bottom: 20px; }
        .status { font-size: 20px; margin-top: 10px; }
        form { margin-bottom: 15px; }
        button { padding: 8px 12px; margin-top: 5px; }
    </style>
</head>
<body>
    <h2>Kontrol Relay</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <div class="card">
        <p><strong>Mode Saat Ini:</strong> {{ $setting->mode }}</p>

        {{-- Ubah Mode --}}
        <form method="POST" action="{{ route('relay.updateMode') }}">
            @csrf
            <select name="mode">
                <option value="otomatis" {{ $setting->mode == 'otomatis' ? 'selected' : '' }}>Otomatis</option>
                <option value="manual" {{ $setting->mode == 'manual' ? 'selected' : '' }}>Manual</option>
            </select>
            <br>
            <button type="submit">Update Mode</button>
        </form>

        @if($setting->mode == 'manual')
            {{-- Status Pompa --}}
            <p class="status">
                Status Pompa: 
                <strong style="color: {{ $setting->status_relay ? 'green' : 'red' }}">
                    {{ $setting->status_relay ? 'MENYALA' : 'MATI' }}
                </strong>
            </p>

            <form method="POST" action="{{ route('relay.updateStatus') }}">
                @csrf
                <input type="hidden" name="status_relay" value="{{ $setting->status_relay ? 0 : 1 }}">
                <button type="submit">
                    {{ $setting->status_relay ? 'Matikan Pompa' : 'Nyalakan Pompa' }}
                </button>
            </form>

            {{-- Status Kipas --}}
            <p class="status">
                Status Kipas: 
                <strong style="color: {{ $setting->status_relay_fan ? 'green' : 'red' }}">
                    {{ $setting->status_relay_fan ? 'MENYALA' : 'MATI' }}
                </strong>
            </p>

            <form method="POST" action="{{ route('relay.updateStatusFan') }}">
                @csrf
                <input type="hidden" name="status_relay_fan" value="{{ $setting->status_relay_fan ? 0 : 1 }}">
                <button type="submit">
                    {{ $setting->status_relay_fan ? 'Matikan Kipas' : 'Nyalakan Kipas' }}
                </button>
            </form>
        @else
            <p class="status"><em>Relay dikontrol otomatis oleh sensor</em></p>
        @endif
    </div>
</body>
</html>
