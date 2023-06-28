<?php

namespace App\Http\Livewire;

use App\Models\CategorieDepense;
use App\Models\TypeCharge;
use Livewire\Component;
use Livewire\WithPagination;

class LivCategorieDepense extends Component
{
    use WithPagination;
    public $isLoading, $type_id, $categorie, $actif, $commentaire;
    public $afficherListe=true;
    public $createType=false;
    public $editType=false;
    public $notification =false; 
    public $confirmUpdate = false; 
    public $recordToDelete;
    public $btnCreate = true;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $types = CategorieDepense::paginate(5);
        return view('.liv-categorie-depense', [
            'types' => $types
        ]);
    }

    public function formType()
    {
        $this->isLoading = true;
        $this->createType =true;
        $this->afficherListe = false;
        $this->btnCreate = false;
        $this->isLoading = false;
    }

    public function resetInput()
    {
        $this->categorie = '';
        $this->commentaire = '';
        $this->actif = '';
        $this->resetValidation();
    }

    public function saveType()
    {
        $this->isLoading = true;
        $data = $this->validate([
            'categorie' => 'required|unique:categorie_depenses,categorie',
            'commentaire' => 'nullable',
            'actif' => 'required|integer'
        ]);

        try{

        CategorieDepense::create($data);
        $this->notification = true;
        session()->flash('message', 'Catégorie depense bien enregistrée!');
        $this->resetValidation();
        $this->resetInput();
        $this->isLoading = false;

        }catch(\Exception $e){

        }

    }

    public function cancelCreate()
    {
        $this->isLoading = true;
        $this->createType = false;
        $this->afficherListe = true;
        $this->resetInput();
        $this->resetValidation();
        $this->btnCreate = true;
        $this->isLoading = false;
    }

    public function editType($id)
    {
        $this->isLoading = true;

        $typeCharge = CategorieDepense::findOrFail($id);
        $this->categorie = $typeCharge->categorie;
        $this->commentaire = $typeCharge->commentaire;
        $this->actif = $typeCharge->actif;
        $this->type_id = $id;
        $this->editType = true;
        $this->createType = false;
        $this->btnCreate = false;
        $this->isLoading = false;
        $this->afficherListe = false;
    }

    public function confirmerUpdate()
    {
        $this->confirmUpdate = true;
    }

    public function updateType()
    {
        $this->isLoading = true;

        $this->validate([
            'categorie' => 'required|unique:categorie_depenses,categorie,' . $this->type_id,
            'commentaire' => 'nullable',
            'actif' => 'required'
        ]);

        try{

            $typeCharge = CategorieDepense::findOrFail($this->type_id);
            $typeCharge->update([
                'categorie' => $this->categorie,
                'commentaire' => $this->commentaire,
                'actif' => $this->actif
            ]);

            $this->editType = false;
            $this->notification = true;
            session()->flash('message', 'Modification bien enregistrée!');
            $this->resetInput();
            $this->resetValidation();
            $this->confirmUpdate = false;
            $this->btnCreate = true;
            $this->isLoading = false;
            $this->afficherListe = true;

        }catch(\Exception $e){

        }

    }

    public function cancelModal()
    {
        $this->isLoading = true;

        $this->confirmUpdate = false;
        $this->editType = true;

        $this->isLoading = false;
    }

    public function cancelUpdate()
    {
        $this->isLoading = true;

        $this->confirmUpdate = false;
        $this->editType = false;
        $this->resetInput();
        $this->resetValidation();
        $this->btnCreate = true;
        $this->afficherListe = true;
        $this->isLoading = false;
    }

    public function confirmerDelete($id)
    {
        $this->recordToDelete = CategorieDepense::findOrFail($id);
    }

    public function cancelDelete()
    {
        $this->recordToDelete = null;
    }

    public function delete()
    {
        $this->recordToDelete->delete();
        $this->recordToDelete = null;
        $this->notification = true;
        session()->flash('message', 'Suppression catégorie avec succée!');
    }

    public function removeNotification()
    {
        $this->dispatchBrowserEvent('removeNotification');
    }

    public function hideNotification()
    {
        $this->notification = false;
    }

}
