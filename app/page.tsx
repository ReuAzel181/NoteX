"use client"

import * as React from 'react'
import { useState, useEffect } from 'react'
import { useRouter } from 'next/navigation'
import { DashboardNav } from '@/components/dashboard-nav'
import { Edit2, Trash2, Sparkles, Zap, Star, Rocket, Brain } from 'lucide-react'

interface Note {
  id: string;
  title: string;
  content: string;
  date: string;
}

const tools = [
  {
    title: "Smart Notes",
    href: "/tools/notes",
    icon: "📝",
    bgColor: "bg-gradient-to-br from-cyan-400 via-blue-500 to-purple-600",
    className: "action-button notes-button",
    description: "AI-powered note-taking with intelligent suggestions",
    accent: "from-cyan-400 to-blue-500"
  },
  {
    title: "Digital Canvas",
    href: "/tools/draw",
    icon: "✏️",
    bgColor: "bg-gradient-to-br from-emerald-400 via-green-500 to-teal-600",
    className: "action-button draw-button",
    description: "Create stunning digital artwork and diagrams",
    accent: "from-emerald-400 to-green-500"
  },
  {
    title: "Scientific Calculator",
    href: "/tools/calculator",
    icon: "🔢",
    bgColor: "bg-gradient-to-br from-purple-400 via-indigo-500 to-blue-600",
    className: "action-button calculator-button",
    description: "Advanced mathematical computations",
    accent: "from-purple-400 to-indigo-500"
  },
  {
    title: "Intelligent Dictionary",
    href: "/tools/dictionary",
    icon: "📚",
    bgColor: "bg-gradient-to-br from-orange-400 via-red-500 to-pink-600",
    className: "action-button dictionary-button",
    description: "AI-powered word definitions and examples",
    accent: "from-orange-400 to-red-500"
  }
]

export default function Home() {
  const router = useRouter();
  const [notes, setNotes] = useState<Note[]>([]);

  useEffect(() => {
    const savedNotes = localStorage.getItem('notes');
    if (savedNotes) {
      setNotes(JSON.parse(savedNotes));
    }
  }, []);

  const handleToolClick = (href: string, title: string) => {
    console.log(`Clicking ${title} button`);
    console.log(`Attempting to navigate to: ${href}`);
    router.push(href);
  };

  const handleEdit = (note: Note) => {
    router.push(`/tools/notes?edit=${note.id}`);
  };

  const handleDelete = (id: string) => {
    const updatedNotes = notes.filter(note => note.id !== id);
    setNotes(updatedNotes);
    localStorage.setItem('notes', JSON.stringify(updatedNotes));
  };

  return (
    <main className="min-h-screen relative overflow-hidden">
      {/* Animated Background Elements */}
      <div className="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
        {/* Floating Orbs */}
        <div className="absolute top-20 left-10 w-32 h-32 bg-gradient-to-r from-cyan-400/20 to-blue-500/20 rounded-full blur-xl animate-float"></div>
        <div className="absolute top-40 right-20 w-24 h-24 bg-gradient-to-r from-purple-400/20 to-pink-500/20 rounded-full blur-xl animate-float" style={{animationDelay: '2s'}}></div>
        <div className="absolute bottom-20 left-1/4 w-40 h-40 bg-gradient-to-r from-emerald-400/20 to-green-500/20 rounded-full blur-xl animate-float" style={{animationDelay: '4s'}}></div>
        <div className="absolute bottom-40 right-1/3 w-28 h-28 bg-gradient-to-r from-orange-400/20 to-red-500/20 rounded-full blur-xl animate-float" style={{animationDelay: '6s'}}></div>
        
        {/* Grid Pattern */}
        <div className="absolute inset-0 bg-[linear-gradient(rgba(59,130,246,0.1)_1px,transparent_1px),linear-gradient(90deg,rgba(59,130,246,0.1)_1px,transparent_1px)] bg-[size:50px_50px]"></div>
      </div>

      <DashboardNav />
      
      <div className="container mx-auto p-4 md:p-8 relative z-10">
        {/* Hero Section */}
        <div className="text-center mb-16 relative">
          <div className="flex items-center justify-center mb-6">
            <div className="relative">
              <Sparkles className="h-12 w-12 text-blue-500 mr-4 animate-pulse" />
              <div className="absolute inset-0 bg-blue-500/30 rounded-full blur-lg animate-pulse"></div>
            </div>
            <h1 className="text-6xl md:text-7xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-cyan-600 bg-clip-text text-transparent animate-text-gradient">
              NoteX
            </h1>
            <div className="relative ml-4">
              <Zap className="h-12 w-12 text-purple-500 animate-bounce" />
              <div className="absolute inset-0 bg-purple-500/30 rounded-full blur-lg animate-pulse"></div>
            </div>
          </div>
          
          <div className="flex items-center justify-center mb-4 space-x-4">
            <div className="flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
              <Brain className="h-5 w-5 text-blue-500" />
              <span className="text-sm font-medium text-gray-700 dark:text-gray-300">AI-Powered</span>
            </div>
            <div className="flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
              <Rocket className="h-5 w-5 text-purple-500" />
              <span className="text-sm font-medium text-gray-700 dark:text-gray-300">Lightning Fast</span>
            </div>
            <div className="flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full border border-white/20">
              <Star className="h-5 w-5 text-yellow-500" />
              <span className="text-sm font-medium text-gray-700 dark:text-gray-300">Premium</span>
            </div>
          </div>
          
          <p className="text-2xl text-muted-foreground mb-2">Your futuristic study companion</p>
          <p className="text-lg text-muted-foreground">Select a tool to begin your journey into the future</p>
        </div>
        
        {/* Tools Grid */}
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
          {tools.map((tool, index) => (
            <button
              key={tool.title}
              onClick={() => handleToolClick(tool.href, tool.title)}
              className={`${tool.bgColor} rounded-3xl p-8 flex flex-col items-center justify-center transition-all duration-700 hover:scale-110 hover:shadow-2xl hover:shadow-blue-500/25 ${tool.className} group relative overflow-hidden transform hover:-translate-y-4`}
              style={{ 
                aspectRatio: '16/9',
                animationDelay: `${index * 200}ms`
              }}
            >
              {/* Animated Background */}
              <div className="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
              <div className="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
              
              {/* Floating Particles */}
              <div className="absolute top-4 right-4 w-2 h-2 bg-white/60 rounded-full animate-ping"></div>
              <div className="absolute bottom-4 left-4 w-1 h-1 bg-white/40 rounded-full animate-pulse" style={{animationDelay: '1s'}}></div>
              
              <div className="text-center relative z-10">
                <div className="text-6xl mb-6 transform group-hover:scale-125 transition-transform duration-500 group-hover:rotate-12">{tool.icon}</div>
                <h2 className="text-2xl font-bold text-white mb-3 drop-shadow-lg">{tool.title}</h2>
                <p className="text-sm text-white/90 opacity-0 group-hover:opacity-100 transition-opacity duration-500 transform translate-y-2 group-hover:translate-y-0">{tool.description}</p>
                
                {/* Accent Line */}
                <div className={`w-0 group-hover:w-16 h-1 bg-gradient-to-r ${tool.accent} rounded-full transition-all duration-700 mt-4 mx-auto`}></div>
              </div>
            </button>
          ))}
        </div>

        {/* Notes Section */}
        <div className="mt-16 relative">
          <div className="text-center mb-12">
            <h2 className="text-4xl font-bold mb-4 bg-gradient-to-r from-gray-800 via-purple-600 to-gray-800 dark:from-gray-200 dark:via-purple-400 dark:to-gray-200 bg-clip-text text-transparent">
              Your Smart Notes
            </h2>
            <div className="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mx-auto"></div>
          </div>
          
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {notes.map((note, index) => (
              <div 
                key={note.id} 
                className="bg-white/90 dark:bg-slate-800/90 backdrop-blur-md border border-white/30 rounded-2xl p-6 hover:shadow-2xl hover:shadow-blue-500/20 transition-all duration-500 hover:scale-105 hover:-translate-y-2 cursor-pointer group"
                style={{ animationDelay: `${index * 100}ms` }}
              >
                {/* Card Glow Effect */}
                <div className="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div className="relative z-10">
                  <div className="flex items-center justify-between mb-4">
                    <h3 className="font-bold text-lg text-gray-800 dark:text-gray-200 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300">{note.title}</h3>
                    <div className="flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button
                      onClick={() => handleEdit(note)}
                        className="text-gray-500 hover:text-blue-500 transition-colors duration-200 p-2 rounded-lg hover:bg-blue-500/10"
                    >
                      <Edit2 className="h-4 w-4" />
                    </button>
                    <button
                      onClick={() => handleDelete(note.id)}
                        className="text-gray-500 hover:text-red-500 transition-colors duration-200 p-2 rounded-lg hover:bg-red-500/10"
                    >
                      <Trash2 className="h-4 w-4" />
                    </button>
                  </div>
                </div>
                  <p className="text-sm text-gray-600 dark:text-gray-400 mb-4">{note.date}</p>
                  <p className="text-sm text-gray-700 dark:text-gray-300 line-clamp-3 group-hover:line-clamp-none transition-all duration-300">{note.content}</p>
                  
                  {/* Accent Border */}
                  <div className="w-0 group-hover:w-full h-0.5 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full transition-all duration-500 mt-4"></div>
                </div>
              </div>
            ))}
            {notes.length === 0 && (
              <div className="col-span-full text-center text-muted-foreground p-12 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-2xl bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm hover:bg-white/70 dark:hover:bg-slate-700/70 transition-all duration-300">
                <div className="text-6xl mb-6 animate-bounce">📝</div>
                <p className="text-2xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">No notes yet</p>
                <p className="text-lg mb-2">Start creating your first smart note</p>
                <p className="text-sm text-gray-500">Use the Smart Notes tool above to get started</p>
              </div>
            )}
          </div>
        </div>
      </div>
    </main>
  )
} 