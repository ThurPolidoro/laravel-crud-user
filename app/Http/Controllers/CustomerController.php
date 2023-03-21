<?php

namespace App\Http\Controllers;

use App\Services\AllCustomerService;
use App\Services\CreateCustomerService;
use App\Services\DeleteCustomerService;
use App\Services\UniqueCustomerService;
use App\Services\UpdateCustomerService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Exibi a tela da lista dos membros cadastrados
     *
     * @return Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('main');
    }

    /**
     * Recebe o request para cadastrar um novo client
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $service = new CreateCustomerService([$request->name, $request->email, $request->phone]);
            $response = $service->createCustomer();

            return response()->json([
                'message' => 'O cliente foi cadastrado em nosso sistema com sucesso!',
                'data' => $response
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function all()
    {
        try {
            $service = new AllCustomerService();
            $response = $service->getDataFromAllCustomers();

            return response()->json([
                'message' => 'As informações dos clientes foi recuperada em nosso sistema com sucesso!',
                'data' => $response
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function unique(int $id)
    {
        try {
            $service = new UniqueCustomerService($id);
            $response = $service->getDataFromASingleCustomer();

            return response()->json([
                'message' => 'As informações do cliente foi recuperada em nosso sistema com sucesso!',
                'data' => $response
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function edit(Request $request, int $id)
    {
        try {
            $service = new UpdateCustomerService($id, [$request->name, $request->email, $request->phone]);
            $response = $service->updateCustomerData();

            return response()->json([
                'message' => 'O informações do foi atualizadas em nosso sistema com sucesso!',
                'data' => $response
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy(int $id)
    {
        try {
            $service = new DeleteCustomerService($id);
            $service->deleteCustomer();

            return response()->json([
                'message' => 'O cliente foi removido de nosso sistema com sucesso!'
            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
