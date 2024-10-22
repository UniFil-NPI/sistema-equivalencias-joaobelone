<script src="https://cdn.tailwindcss.com"></script>
<div class="p-10"> <!-- Reduced padding -->
    <div class="container mx-auto pt-6 pb-4"> <!-- Reduced padding -->
        <div class="bg-white overflow-hidden">
            <div class="flex justify-between">
                <h2 class="font-semibold text-lg text-gray-800 leading-tight"> <!-- Reduced font size -->
                    Resultado da geração de equivalências -
                    <span class="text-amber-500">{{ $resultado['titulo'] }}</span>
                </h2>
                <h4 class="text-sm">{{ $resultado->created_at->locale('pt_BR')->format('d/m/Y H:i:s') }}</h4>
                <!-- Reduced font size -->
            </div>
        </div>
        <div class="pt-4"> <!-- Reduced padding -->
            <h2 class="text-lg font-bold"> <!-- Reduced font size -->
                Disciplinas cursadas na grade antiga -
                <span class="text-amber-500">{{ $resultado->gradeAntiga['titulo'] ?? '' }}</span>
            </h2>
            <table class="min-w-full leading-normal text-sm"> <!-- Set a smaller text size -->
                <thead>
                    <tr>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Código
                        </th>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Título
                        </th>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Carga Horária
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultado->disciplinasCursadas as $disciplina)
                        <tr>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">{{ $disciplina['codigo'] }}</td>
                            <!-- Reduced font size -->
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">{{ $disciplina['titulo'] }}</td>
                            <!-- Reduced font size -->
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">
                                {{ $disciplina['pivot']['carga_horaria'] }}</td> <!-- Reduced font size -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-3 py-3 border-b border-gray-200 bg-white text-xs text-center">
                                <!-- Reduced font size -->
                                Nenhuma disciplina encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-4"> <!-- Reduced padding -->
            <h2 class="text-lg font-bold"> <!-- Reduced font size -->
                Disciplinas abatidas da grade nova -
                <span class="text-amber-500">{{ $resultado->gradeNova['titulo'] ?? '' }}</span>
            </h2>
            <table class="min-w-full leading-normal text-sm"> <!-- Set a smaller text size -->
                <thead>
                    <tr>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Código
                        </th>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Título
                        </th>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Carga Horária
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultado->disciplinasAbatidas as $disciplina)
                        <tr>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">{{ $disciplina['codigo'] }}</td>
                            <!-- Reduced font size -->
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">{{ $disciplina['titulo'] }}</td>
                            <!-- Reduced font size -->
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">
                                {{ $disciplina['carga_horaria'] }}</td> <!-- Reduced font size -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-3 py-3 border-b border-gray-200 bg-white text-xs text-center">
                                <!-- Reduced font size -->
                                Nenhuma disciplina encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pt-4"> <!-- Reduced padding -->
            <h2 class="text-lg font-bold"> <!-- Reduced font size -->
                Disciplinas a cursar na grade nova -
                <span class="text-amber-500">{{ $resultado->gradeNova['titulo'] ?? '' }}</span>
            </h2>
            <table class="min-w-full leading-normal text-sm"> <!-- Set a smaller text size -->
                <thead>
                    <tr>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Código
                        </th>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Título
                        </th>
                        <th
                            class="px-3 py-2 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <!-- Reduced padding -->
                            Carga Horária
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($resultado->disciplinasAtribuidas as $disciplina)
                        <tr>
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">{{ $disciplina['codigo'] }}</td>
                            <!-- Reduced font size -->
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">{{ $disciplina['titulo'] }}</td>
                            <!-- Reduced font size -->
                            <td class="px-3 py-3 border-b border-gray-200 bg-white text-xs">
                                {{ $disciplina['carga_horaria'] }}</td> <!-- Reduced font size -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-3 py-3 border-b border-gray-200 bg-white text-xs text-center">
                                <!-- Reduced font size -->
                                Nenhuma disciplina encontrada.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- @dd('debug') --}}
