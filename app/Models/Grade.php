<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    /**
     * Método para obter todas as notas de um determinado usuário.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAllGradesByUserId($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    /**
     * Método para criar uma nova nota para um determinado usuário.
     *
     * @param int $userId
     * @param string $modalidade
     * @param string $nota
     * @return \App\Models\Grade
     */
    public static function createGrade($userId, $modalidade, $nota)
    {
        return self::create([
            'user_id' => $userId,
            'modalidade' => $modalidade,
            'nota' => $nota,
        ]);
    }

    /**
     * Método para atualizar uma nota existente.
     *
     * @param int $gradeId
     * @param string $modalidade
     * @param string $nota
     * @return \App\Models\Grade
     */
    public static function updateGrade($gradeId, $modalidade, $nota)
    {
        $grade = self::find($gradeId);
        if ($grade) {
            $grade->modalidade = $modalidade;
            $grade->nota = $nota;
            $grade->save();
        }
        return $grade;
    }

    /**
     * Método para excluir uma nota existente.
     *
     * @param int $gradeId
     * @return bool
     */
    public static function deleteGrade($gradeId)
    {
        $grade = self::find($gradeId);
        if ($grade) {
            return $grade->delete();
        }
        return false;
    }
}
