import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Index({ auth, tasks, flash }) {
    const { delete: destroy } = useForm();

    console.log(auth);
    console.log(tasks);
    console.log(flash);

    function submit(url) {
        destroy(url);
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    ToDo List
                </h2>
            }
        >
            <Head title="Tasks" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Tarefas</div>

                        {tasks.data.map((task) => (
                            <div key={task.id}>
                                <p>{task.id}</p>
                                <p>{task.title}</p>
                                <p>{task.description}</p>
                                <p>{task.term}</p>
                                <a href={task.urls.url_edit}>
                                    Editar
                                </a>
                                <br />
                                <a href={task.urls.url_show}>
                                    Visualizar
                                </a>
                                <br />
                                <form onSubmit={(e) => {
                                    e.preventDefault();
                                    submit(task.urls.url_delete);
                                }}>
                                    <button type="submit">Deletar</button>
                                </form>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
