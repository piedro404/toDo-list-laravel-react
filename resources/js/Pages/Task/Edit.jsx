import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Show({ auth, task, urls }) {
    const { data, setData, put, processing, errors } = useForm({
        title: task.data.title,
        description: task.data.description,
        status: task.data.status,
        deadline: task.data.deadline
            ? task.data.deadline
            : new Date(new Date().setMonth(new Date().getMonth() + 1))
                  .toISOString()
                  .slice(0, 16),
    });

    console.log(auth);
    console.log(task);
    console.log(urls);
    console.log(data);
    console.log(errors);
    // alert(errors.title);

    function submit(e) {
        e.preventDefault();
        put(urls.url_update);
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    ToDo List - Editar Tarefa {task.data.title}
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

                        <form onSubmit={submit}>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                required
                                value={data.title}
                                onChange={(e) =>
                                    setData("title", e.target.value)
                                }
                            />
                            {errors.title && <p>{errors.title}</p>}

                            <input
                                type="text"
                                name="description"
                                id="description"
                                value={data.description}
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                            />
                            {errors.description && <p>{errors.description}</p>}

                            <input
                                type="datetime-local"
                                name="deadline"
                                id="deadline"
                                value={data.deadline || ""}
                                onChange={(e) =>
                                    setData("deadline", e.target.value || null)
                                }
                            />
                            {errors.deadline && <p>{errors.deadline}</p>}

                            <div>
                                <label>
                                    <input
                                        type="radio"
                                        name="status"
                                        value={1}
                                        checked={data.status === 1}
                                        onChange={() => setData("status", 1)}
                                    />
                                    On
                                </label>
                                <label>
                                    <input
                                        type="radio"
                                        name="status"
                                        value={0}
                                        checked={data.status === 0}
                                        onChange={() =>
                                            setData("status", 0)
                                        }
                                    />
                                    Off
                                </label>
                            </div>
                            {errors.status && <p>{errors.status}</p>}

                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
