"use client"

import * as React from 'react'
import { useState, useEffect } from 'react'
import { DashboardNav } from '@/components/dashboard-nav'
import { Button } from '@/components/ui/button'
import { Save, FolderPlus, Trash2, Edit2, Sparkles } from 'lucide-react'
import { useSearchParams } from 'next/navigation'

interface Note {
  id: string;
  title: string;
  content: string;
  date: string;
}

export default function NotesPage() {
  const [content, setContent] = useState('')
  const [title, setTitle] = useState('')
  const [notes, setNotes] = useState<Note[]>([])
  const [editingNote, setEditingNote] = useState<Note | null>(null)
  const searchParams = useSearchParams()

  // Load notes from localStorage on initial render
  useEffect(() => {
    const savedNotes = localStorage.getItem('notes')
    if (savedNotes) {
      setNotes(JSON.parse(savedNotes))
    }
  }, [])

  // Check for edit parameter in URL
  useEffect(() => {
    const editId = searchParams.get('edit')
    if (editId && notes.length > 0) {
      const noteToEdit = notes.find(note => note.id === editId)
      if (noteToEdit) {
        handleEdit(noteToEdit)
      }
    }
  }, [notes, searchParams])

  // Save notes to localStorage whenever they change
  useEffect(() => {
    localStorage.setItem('notes', JSON.stringify(notes))
  }, [notes])

  const handleSave = () => {
    if (!title.trim() || !content.trim()) return

    if (editingNote) {
      setNotes(notes.map(note => 
        note.id === editingNote.id 
          ? { ...note, title, content, date: new Date().toLocaleString() }
          : note
      ))
      setEditingNote(null)
    } else {
      const newNote: Note = {
        id: Date.now().toString(),
        title,
        content,
        date: new Date().toLocaleString()
      }
      setNotes([newNote, ...notes])
    }

    setTitle('')
    setContent('')
  }

  const handleEdit = (note: Note) => {
    setEditingNote(note)
    setTitle(note.title)
    setContent(note.content)
  }

  const handleDelete = (id: string) => {
    setNotes(notes.filter(note => note.id !== id))
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
      <DashboardNav />
      <main className="container mx-auto p-4 md:p-8">
        <div className="flex items-center justify-between mb-8">
          <div className="flex items-center space-x-3">
            <div className="relative">
              <Sparkles className="h-8 w-8 text-blue-500" />
              <div className="absolute inset-0 bg-blue-500/20 rounded-full blur-sm"></div>
            </div>
            <div>
              <h1 className="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-cyan-600 bg-clip-text text-transparent">
                Smart Notes
              </h1>
              <p className="text-muted-foreground">AI-powered note-taking experience</p>
            </div>
          </div>
          <div className="flex gap-4">
            <Button variant="outline" size="icon" className="border-white/20 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70 transition-all duration-300">
              <FolderPlus className="h-4 w-4" />
            </Button>
          </div>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div className="md:col-span-2">
            <div className="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300">
              <input
                type="text"
                placeholder="Note title..."
                className="w-full mb-6 p-4 bg-white/50 dark:bg-slate-700/50 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all duration-300 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                value={title}
                onChange={(e) => setTitle(e.target.value)}
              />
              <textarea
                className="w-full h-[50vh] bg-white/50 dark:bg-slate-700/50 border border-white/20 rounded-xl p-4 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-transparent transition-all duration-300 placeholder:text-gray-500 dark:placeholder:text-gray-400"
                placeholder="Start typing your notes here... Let AI assist you with intelligent suggestions..."
                value={content}
                onChange={(e) => setContent(e.target.value)}
              />
              <div className="flex justify-end mt-6">
                <Button 
                  onClick={handleSave}
                  className="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl transition-all duration-300 hover:scale-105 hover:shadow-lg"
                >
                  <Save className="h-4 w-4 mr-2" />
                  {editingNote ? 'Update Note' : 'Save Note'}
                </Button>
              </div>
            </div>
          </div>

          <div className="space-y-4">
            <h2 className="text-2xl font-bold mb-6 bg-gradient-to-r from-gray-800 to-gray-600 dark:from-gray-200 dark:to-gray-400 bg-clip-text text-transparent">
              Your Notes
            </h2>
            <div className="space-y-4 max-h-[70vh] overflow-y-auto">
              {notes.map((note, index) => (
                <div 
                  key={note.id} 
                  className="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border border-white/20 rounded-xl p-4 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 hover:scale-105 cursor-pointer"
                  style={{ animationDelay: `${index * 50}ms` }}
                >
                  <div className="flex items-center justify-between mb-3">
                    <h3 className="font-semibold text-gray-800 dark:text-gray-200">{note.title}</h3>
                    <div className="flex gap-2">
                      <button
                        onClick={() => handleEdit(note)}
                        className="text-gray-500 hover:text-blue-500 transition-colors duration-200 p-1 rounded-lg hover:bg-blue-500/10"
                      >
                        <Edit2 className="h-4 w-4" />
                      </button>
                      <button
                        onClick={() => handleDelete(note.id)}
                        className="text-gray-500 hover:text-red-500 transition-colors duration-200 p-1 rounded-lg hover:bg-red-500/10"
                      >
                        <Trash2 className="h-4 w-4" />
                      </button>
                    </div>
                  </div>
                  <p className="text-sm text-gray-600 dark:text-gray-400 mb-3">{note.date}</p>
                  <p className="text-sm text-gray-700 dark:text-gray-300 line-clamp-3">{note.content}</p>
                </div>
              ))}
              {notes.length === 0 && (
                <div className="text-center text-muted-foreground p-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm">
                  <div className="text-4xl mb-4">📝</div>
                  <p className="text-lg font-medium mb-2">No notes yet</p>
                  <p className="text-sm">Start creating your first smart note</p>
                </div>
              )}
            </div>
          </div>
        </div>
      </main>
    </div>
  )
} 