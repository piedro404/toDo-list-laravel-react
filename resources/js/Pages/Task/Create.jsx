import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage, router, useForm } from "@inertiajs/react";
import { useState } from "react";

export default function Index({ auth, url_store }) {
    const { data, setData, post, processing, errors } = useForm({
        title: "",
        description: "",
        deadline: new Date(new Date().setMonth(new Date().getMonth() + 1))
            .toISOString()
            .slice(0, 16),
    });

    console.log(auth);
    console.log(url_store);
    console.log(data);
    console.log(errors);
    // alert(errors.title);

    function submit(e) {
        e.preventDefault();
        post(url_store);
    }

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    ToDo List - Criar
                </h2>
            }
        >
            <Head title="Tasks" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">Criar Tarefas</div>
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
                            {errors.title && (
                                <p>{errors.title}</p>
                            )}
                            <input
                                type="text"
                                name="description"
                                id="description"
                                value={data.description}
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                            />
                            {errors.description && (
                                <p>{errors.description}</p>
                            )}
                            <input
                                type="datetime-local"
                                name="deadline"
                                id="deadline"
                                value={data.deadline || ""}
                                onChange={(e) =>
                                    setData("deadline", e.target.value || null)
                                }
                            />
                            {errors.deadline && (
                                <p>{errors.deadline}</p>
                            )}

                            <button type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
