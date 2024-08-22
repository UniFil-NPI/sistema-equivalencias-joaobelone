<script src="https://cdn.tailwindcss.com"></script>
<div class="p-20">
    <div class="container mx-auto pt-12 pb-6">
        <div class="bg-white overflow-hidden">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Resultado da geração de equivalências -
                    <span class="text-amber-500">{{ $resultado['titulo'] }}</span>
                </h2>
                <h4>{{ $resultado->created_at->locale('pt_BR')->format('d/m/Y H:i:s') }}</h4>
            </div>
        </div>
        <div class="pt-6">
            <h2 class="text-xl font-bold">
                Disciplinas cursadas na grade antiga -
                <span class="text-amber-500">{{ $resultado->gradeAntiga['titulo'] ?? '' }}</span>
            </h2>
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Código</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Título</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Carga Horária</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultado->disciplinasCursadas as $disciplina)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $disciplina['codigo'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $disciplina['titulo'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $disciplina['pivot']['carga_horaria'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                Nenhuma disciplina encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-6">
            <h2 class="text-xl font-bold">
                Disciplinas abatidas da grade nova -
                <span class="text-amber-500">{{ $resultado->gradeNova['titulo'] ?? '' }}</span>
            </h2>
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Código</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Título</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Carga Horária</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultado->disciplinasAbatidas as $disciplina)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $disciplina['codigo'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $disciplina['titulo'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $disciplina['carga_horaria'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                Nenhuma disciplina encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-6">
            <h2 class="text-xl font-bold">
                Disciplinas a cursar na grade nova -
                <span class="text-amber-500">{{ $resultado->gradeNova['titulo'] ?? '' }}</span>
            </h2>
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Código</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Título</th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Carga Horária</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultado->disciplinasAtribuidas as $disciplina)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $disciplina['codigo'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $disciplina['titulo'] }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $disciplina['carga_horaria'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                Nenhuma disciplina encontrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
{{-- @dd('debug') --}}
