<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\Employee;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function index(): JsonResponse
    {
        $employess = $this->em->getRepository(Employee::class)->findAll();

        return response()->json($employess);
    }


    public function store(Request $request): JsonResponse
    {
        $employee = new Employee();
        $employee->setFirstName($request->firstName);
        $employee->setLastName($request->lastName);
        $this->em->persist($employee);
        $this->em->flush();

        return response()->json();
    }

    public function show($id): JsonResponse
    {
        $employee = $this->em->getRepository(Employee::class)->find($id);

        return response()->json($employee);
    }


    public function update(Request $request, $id): JsonResponse
    {
        $employee = $this->em->getRepository(Employee::class)->find($id);
        $employee->setFirstName($request->firstName);
        $employee->setLastName($request->lastName);
        $this->em->flush();

        return response()->json();
    }

    public function destroy($id): JsonResponse
    {
        $employee = $this->em->getRepository(Employee::class)->find($id);
        $this->em->remove($employee);
        $this->em->flush();

        return response()->json();
    }
}
