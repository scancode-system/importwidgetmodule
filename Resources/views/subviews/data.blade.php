<div class="brand-card-body">
    <div>
        <div class="text-value">{{ $new }}</div>
        <div class="text-uppercase text-muted small">Novo</div>
    </div>
    <div>
        <div class="text-value">{{ $updated }}</div>
        <div class="text-uppercase text-muted small">Atualizado</div>
    </div>
    <div>
        <div class="text-value">{{ $failures }}</div>
        <div class="text-uppercase text-muted small">Falha</div>
    </div>
    @if($completed == 100 && ($failures > 0))
    <div>
        <a href="{{ route('importwidget.report', $module.$method) }}" class="text-muted text-decoration-none">
            <i class="fa fa-file-text-o fa-lg  fa-2x mb-2"></i><br>
            Relatório
        </a>
    </div>
    @endif
</div>