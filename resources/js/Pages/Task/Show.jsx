import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Show({ auth, task, urls }) {
    const { delete: destroy } = useForm();
    
    console.log(auth);
    console.log(task);
    console.log(urls);

    function submit(e) {
        e.preventDefault();
        destroy(urls.url_delete);
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    ToDo List - Detalhes da Tarefa {task.data.title}
                </h2>
            }
        >
            <Head title="Tasks" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Tarefa</div>
                        <div key={task.data.id}>
                            <p>{task.data.title}</p>
                            <p>{task.data.description}</p>
                            <p>{task.data.term}</p>
                        </div>
                        <a href={urls.url_edit}>Editar</a>
                        <br />
                        <form onSubmit={submit}>
                            <button type="submit">Deletar</button>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
