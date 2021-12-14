<?php

namespace App\DataTables;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\ComponentAttributeBag;
use App\Models\Product;
use App\Models\Category;
use Yajra\DataTables\Services\DataTable;
use Yajra\Datatables\Facades\Datatables;

/**
 * KLasa odpowiedzialna za generowanie dany dla komponentu DataTable
 */
class ProductDataTable extends DataTable
{
    /**
     * Filtry kolumn
     * @var array
     */
    const SQL_RAW_FILTER = [
        'products_count' => '(SELECT count(*) FROM products
            WHERE products.category_id = categories.id
            AND products.deleted_at IS NULL)'
    ];

    /**
     * Generuje odpowiedź dla komponentu
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $datatable = DataTables::eloquent($this->query())
            ->editColumn('created_at', function ($category) {
                return $category->created_at;
            })
            ->editColumn('updated_at', function ($category) {
                return $category->updated_at;
            })
            ->editColumn('deleted_at', function ($category) {
                return $category->deleted_at;
            })
            // globalne wyszukiwanie
            ->filter(function ($query) {
                /*
                    Napisanie tej funkcji wyłącza domyślne globalne wyszukiwanie.
                    Można je obsłużyć ręcznie.
                    Jeśli nad kolumnami są pola select, które powinny być wyszukiwane
                    operatorem = to tutaj dokładamy wyszukiwanie operatorem LIKE
                 */
                $search = request('search');
                $columns = request('columns');

                if(!isset($search['value']) || \strlen($search['value']) === 0) {
                    return;
                }
                $query->where(function($query) use ($search, $columns) {
                    foreach ($columns as $key => $column) {
                        if($column['searchable'] === 'true') {
                            switch($column['name']) {
                                case 'products_count':
                                    $query->orWhereRaw(
                                        self::SQL_RAW_FILTER['products_count'] . ' = ?',
                                        [$search['value']]
                                    );
                                    break;
                                default:
                                    $query->orWhereRaw(
                                        $column['name'] . ' LIKE ?',
                                        ['%' . $search['value'] . '%']
                                    );
                            }
                        }
                    }
                });
            })
            // filtrowanie po wybranej kolumnie
            ->filterColumn('products_count', function ($query, $keyword) {
                $query->whereRaw(
                    self::SQL_RAW_FILTER['products_count'] . ' = ?',
                    [$keyword]
                );
            })
            // dodanie dodatkowej kolumny
            ->addColumn('action', function($category) {
                $buttons = '<span class="btn-group float-right">';

                if (!isset($category->deleted_at))
                {
                    // przycisk szczegółów
                    $buttons .= '<a class="btn btn-primary btn-sm"';
                    $buttons .= ' href="' . route('categories.show', $category->id) .'"';
                    $buttons .= 'data-toggle="tooltip"
                        data-placement="top"';
                    $buttons .= 'data-title="' . __('translations.buttons.show') . '"';
                    $buttons .= '><span class="fas fa-info-circle" aria-hidden="true">
                        </span></a>';

                    if (Auth::user())
                    {
                        // przycisk edycji
                        $buttons .= '<a class="btn btn-primary btn-sm"';
                        $buttons .= ' href="' . route('categories.edit', $category->id) .'"';
                        $buttons .= 'data-toggle="tooltip"
                            data-placement="top"';
                        $buttons .= 'data-title="' . __(
                                'translations.buttons.edit', ['model' => 'kategorię']
                            ) . '"';
                        $buttons .= '><span class="far fa-edit" aria-hidden="true">
                            </span></a>';
                    }
                    if (Auth::user())
                    {
                        // przycisk usuwania
                        $buttons .= '<button type="button"
                            class="btn btn-danger btn-sm destroy-button"
                            data-toggle="tooltip"
                            data-placement="top"';
                        $buttons .= 'data-url="'
                            . route('categories.destroy', ['id' => $category->id])
                            . '"';
                        $buttons .= 'data-title="'
                            . __('translations.buttons.delete')
                            . '"';
                        $buttons .= 'data-message="'
                            . __('translations.categories.destroy.messages.question')
                            . ' ' . $category->name . '?'
                            . '"';
                        $buttons .= '">';
                        $buttons .= '<span class="fas fa-power-off" aria-hidden="true"></span>
                            </button>';
                    }
                } else {
                    if (Auth::user())
                    {                    
                        // przycisk przywracania usuniętego elementu
                        $buttons .= '<a class="btn btn-success btn-sm"';
                        $buttons .= ' href="' . route('categories.restore', $category->id) .'"';
                        $buttons .= 'data-toggle="tooltip"
                            data-placement="top"';
                        $buttons .= 'data-title="' . __('translations.buttons.restore') . '"';
                        $buttons .= '><span class="fas fa-power-off" aria-hidden="true">
                            </span></a>';
                    }
                }

                $buttons .= '</span>';
                return $buttons;
            })
            // które kolumny mają być renderowane z uwzględnieniam kodu HTML
            ->rawColumns(['action']);

        return $datatable->make(true);
    }

    /**
     * Budowa zapytania zwracającego dane dla Datatable
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $categories = Category::withTrashed()->withCount('products');
        return $this->applyScopes($categories);
    }

    private function getDestroyButton(Product $product): string
    {
        if (isset($product->deleted_at)) {
            return '';
        }
        if (!Auth::user()) {
            return '';
        }
        return view('components.datatables.confirm', [
            'slot' => '<i class="bi bi-trash"></i>',
            'attributes' => new ComponentAttributeBag([
                'action' => route('products.destroy', $product),
                'method' => 'DELETE',
                'confirm-text' => __('translations.buttons.yes'),
                'confirm-class' => 'btn btn-danger me-2',
                'cancel-text' => __('translations.buttons.no'),
                'cancel-class' => 'btn btn-secondary ms-2',
                'icon' => 'question',
                'message' => __('translations.products.labels.destroy-question', ['name' => $product->name]),
                'button-class' => 'btn btn-danger',
                'button-title' => __('translations.products.labels.destroy')
            ])
        ])->render();
    }

    private function getActionButtons(Product $product): string
    {
        $buttons = '<div class="btn-group" role="group" aria-label="action buttons">';
        $buttons .= $this->getDestroyButton($product);
        $buttons .= $this->getRestoreButton($product);

        $buttons .= '</div>';
        return $buttons;
    }

    private function getRestoreButton(Product $product): string
    {
        if (!isset($product->deleted_at)) {
            return '';
        }
        if (!Auth::user()) {
            return '';
        }
        return view('components.datatables.confirm', [
            'slot' => '<i class="bi bi-trash"></i>',
            'attributes' => new ComponentAttributeBag([
                'action' => route('products.restore', $product),
                'method' => 'PUT',
                'confirm-text' => __('translations.buttons.yes'),
                'confirm-class' => 'btn btn-success me-2',
                'cancel-text' => __('translations.buttons.no'),
                'cancel-class' => 'btn btn-secondary ms-2',
                'icon' => 'question',
                'message' => __('translations.products.labels.restore-question', ['name' => $product->name]),
                'button-class' => 'btn btn-success',
                'button-title' => __('translations.products.labels.restore')
            ])
        ])->render();
    }
}
